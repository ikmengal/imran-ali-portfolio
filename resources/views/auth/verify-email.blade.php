@extends('auth.master')
@push('title', 'Verify Email')

@section('content')
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img
                    src="{{ asset('admin/assets/img/illustrations/auth-verify-email-illustration-light.png') }}"
                    alt="auth-verify-email-cover"
                    class="img-fluid my-5 auth-illustration"
                    data-app-light-img="illustrations/auth-verify-email-illustration-light.png"
                    data-app-dark-img="illustrations/auth-verify-email-illustration-dark.png"
                    />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Verify Email -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-500 mx-auto text-center">
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
                    <h3 class="mb-1 fw-bold">Verify Your Email 👋</h3>
                    <p class="mb-4">Thanks for registering! Please verify your email address.</p>

                    @if (session('status'))
                        <div id="errorMessage" class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="space-y-4">
                        <p class="text-muted">A fresh verification link has been sent to your email address.</p>

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Resend Verification Email</button>
                        </form>
                    </div>

                    <p class="text-center mt-4">
                        <a href="{{ route('login') }}" class="fw-medium text-primary"> Back to Login</a>
                    </p>
                </div>
            </div>
            <!-- /Verify Email -->
        </div>
    </div>
    <!-- Content -->
@endsection