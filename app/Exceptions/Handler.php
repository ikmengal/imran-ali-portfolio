<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e, Request $request) {
            // Determine if this is an admin request
            $isAdmin = $request->is('admin/*') || $request->is('admin') || 
                       str_starts_with($request->path(), 'admin');

            if ($isAdmin) {
                return $this->renderAdminError($e, $request);
            }

            return $this->renderFrontendError($e, $request);
        });
    }

    /**
     * Render admin error page with unified design
     */
    public function renderAdminError(Throwable $e, Request $request)
    {
        $statusCode = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;
        
        $errorData = $this->getErrorData($statusCode, $e);
        
        return response()->view('errors.layout', $errorData, $statusCode);
    }

    /**
     * Render frontend error page with unified design
     */
    public function renderFrontendError(Throwable $e, Request $request)
    {
        $statusCode = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;
        
        $errorData = $this->getErrorData($statusCode, $e);
        
        return response()->view('errors.layout', $errorData, $statusCode);
    }

    /**
     * Get error data based on status code
     */
    protected function getErrorData(int $statusCode, Throwable $e): array
    {
        $errorConfig = [
            403 => [
                'code' => '403',
                'title' => 'Access Denied',
                'message' => 'You don\'t have permission to access this page. Please contact the administrator if you believe this is an error.',
                'actions' => [
                    ['url' => route('portfolio'), 'label' => 'Go Home', 'icon' => 'ph-fill ph-house', 'variant' => 'primary'],
                    ['url' => 'javascript:history.back()', 'label' => 'Go Back', 'icon' => 'ph-fill ph-arrow-left', 'variant' => 'secondary'],
                ],
            ],
            404 => [
                'code' => '404',
                'title' => 'Page Not Found',
                'message' => 'Sorry, we couldn\'t find the page you\'re looking for. It might have been moved, deleted, or never existed.',
                'actions' => [
                    ['url' => route('portfolio'), 'label' => 'Back to Home', 'icon' => 'ph-fill ph-house', 'variant' => 'primary'],
                    ['url' => 'javascript:history.back()', 'label' => 'Go Back', 'icon' => 'ph-fill ph-arrow-left', 'variant' => 'secondary'],
                ],
                'helpLinks' => [
                    'label' => 'Or explore these sections:',
                    'links' => [
                        ['url' => route('portfolio') . '#about', 'label' => 'About Me'],
                        ['url' => route('portfolio') . '#projects', 'label' => 'Projects'],
                        ['url' => route('portfolio') . '#contact', 'label' => 'Contact'],
                    ],
                ],
            ],
            419 => [
                'code' => '419',
                'title' => 'Session Expired',
                'message' => 'Your session has expired for security reasons. Please refresh the page to start a new session.',
                'actions' => [
                    ['url' => 'javascript:location.reload()', 'label' => 'Refresh Page', 'icon' => 'ph-fill ph-refresh', 'variant' => 'primary'],
                    ['url' => route('portfolio'), 'label' => 'Go Home', 'icon' => 'ph-fill ph-house', 'variant' => 'secondary'],
                ],
            ],
            500 => [
                'code' => '500',
                'title' => 'Server Error',
                'message' => 'Something went wrong on our end. Our team has been notified and we\'re working to fix it. Please try again in a few moments.',
                'actions' => [
                    ['url' => 'javascript:location.reload()', 'label' => 'Try Again', 'icon' => 'ph-fill ph-refresh', 'variant' => 'primary'],
                    ['url' => route('portfolio'), 'label' => 'Go Home', 'icon' => 'ph-fill ph-house', 'variant' => 'secondary'],
                ],
                'helpLinks' => [
                    'label' => 'If this problem persists:',
                    'links' => [
                        ['url' => '#', 'label' => 'Refresh the page'],
                        ['url' => '#', 'label' => 'Clear browser cache'],
                        ['url' => route('portfolio') . '#contact', 'label' => 'Contact Support'],
                    ],
                ],
            ],
            503 => [
                'code' => '503',
                'title' => 'Maintenance Mode',
                'message' => 'We\'re currently performing scheduled maintenance to improve your experience.',
                'actions' => [
                    ['url' => 'javascript:location.reload()', 'label' => 'Check Again', 'icon' => 'ph-fill ph-refresh', 'variant' => 'primary'],
                    ['url' => route('portfolio'), 'label' => 'Go Home', 'icon' => 'ph-fill ph-house', 'variant' => 'secondary'],
                ],
            ],
        ];

        return $errorConfig[$statusCode] ?? [
            'code' => (string)$statusCode,
            'title' => 'Something Went Wrong',
            'message' => $this->app->hasDebugModeEnabled() ? $e->getMessage() : 'An unexpected error occurred. Please try again later.',
            'exception' => config('app.debug') ? $e : null,
            'actions' => [
                ['url' => 'javascript:location.reload()', 'label' => 'Try Again', 'icon' => 'ph-fill ph-refresh', 'variant' => 'primary'],
                ['url' => route('portfolio'), 'label' => 'Go Home', 'icon' => 'ph-fill ph-house', 'variant' => 'secondary'],
            ],
        ];
    }
}