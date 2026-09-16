@extends('auth.master')
@push('title', 'Forgot Password')

@section('content')
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img
                    src="{{ asset('admin/assets/img/illustrations/auth-forgot-password-illustration-light.png') }}"
                    alt="auth-forgot-password-cover"
                    class="img-fluid my-5 auth-illustration"
                    data-app-light-img="illustrations/auth-forgot-password-illustration-light.png"
                    data-app-dark-img="illustrations/auth-forgot-password-illustration-dark.png"
                    />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Forgot Password -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-500 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <a href="{{ route('login') }}" class="app-brand-link gap-2">
                            <span class="app-brand">
                                @if(isset(setting()->logo) && !empty(setting()->logo))
                                    <img width="250" src="{{ asset('admin/assets/settings') }}/{{ setting()->logo }}" class="img-fluid light-logo" alt="Logo" />
                                @else
                                    <img width="250" src="{{ asset('admin/assets/logo/vertical-b-logo.png') }}" class="img-fluid " alt="Logo" />
                                @endif
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h3 class="mb-1 fw-bold">Forgot Password? 👋</h3>
                    <p class="mb-4">Enter your email and we'll send you a reset link</p>

                    @if (session('status'))
                        <div id="errorMessage" class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div id="errorMessage" class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form id="forgotPasswordForm" class="mb-3" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required autofocus />
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary d-grid w-100">Send Reset Link</button>
                        </div>
                    </form>
                    <p class="text-center mt-4">
                        Remember your password?
                        <a href="{{ route('login') }}" class="fw-medium text-primary"> Sign in</a>
                    </p>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>
    <!-- Content -->
@endsection