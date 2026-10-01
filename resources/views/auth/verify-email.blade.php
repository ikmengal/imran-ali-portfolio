@extends('admin.layouts.app')

@section('title', 'Verify Your Email Address')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a href="{{ route('admin.dashboard') }}" class="app-brand-link gap-2">
                                <img src="{{ setting()->logo ? asset('admin/assets/settings/' . setting()->logo) : asset('admin/assets/logo/vertical-w-logo.png') }}" alt="Logo" class="img-fluid" style="height: 40px;">
                            </a>
                        </div>

                        <div class="text-center mb-4">
                            <h4 class="mb-2">Verify Your Email Address</h4>
                            <p class="text-muted">Thanks for registering! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another one.</p>
                        </div>

                        <div class="d-grid gap-2">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-mail me-1"></i> Resend Verification Email
                                </button>
                            </form>

                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-back me-1"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection