<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 text-center">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900">Verify Your Email Address</h2>
            <p class="mt-2 text-sm text-gray-600">Thanks for registering! Please verify your email address.</p>
        </div>

        @if (session('status'))
            <div class="text-green-600 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <div class="space-y-4">
            <p class="text-sm text-gray-600">A fresh verification link has been sent to your email address.</p>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Resend Verification Email
                </button>
            </form>
        </div>

        <p class="text-sm text-gray-600"><a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">Back to login</a></p>
    </div>
</body>
</html>