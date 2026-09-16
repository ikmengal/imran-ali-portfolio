@extends('auth.master')
@push('title', 'Reset Password')

@section('content')
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img
                    src="{{ asset('admin/assets/img/illustrations/auth-reset-password-illustration-light.png') }}"
                    alt="auth-reset-password-cover"
                    class="img-fluid my-5 auth-illustration"
                    data-app-light-img="illustrations/auth-reset-password-illustration-light.png"
                    data-app-dark-img="illustrations/auth-reset-password-illustration-dark.png"
                    />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Reset Password -->
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
                    <h3 class="mb-1 fw-bold">Reset Password 👋</h3>
                    <p class="mb-4">Enter your new password below</p>

                    @if ($errors->any())
                        <div id="errorMessage" class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form id="resetPasswordForm" class="mb-3" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $email }}" placeholder="Enter your email" required />
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password_confirmation" required />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary d-grid w-100">Reset Password</button>
                        </div>
                    </form>
                    <p class="text-center mt-4">
                        <a href="{{ route('login') }}" class="fw-medium text-primary"> Back to Login</a>
                    </p>
                </div>
            </div>
            <!-- /Reset Password -->
        </div>
    </div>
    <!-- Content -->
@endsection

@push('js')
    <script>
        $(document).on('click','i[class^="ti ti-eye"]',function(){
            var getType=$(this).parent().parent().find('input').attr('type');
            if(getType!='text'){
                $(this).attr('class','ti ti-eye-off');
                $(this).parent().parent().find('input').attr('type','password');
            }else{
                $(this).attr('class','ti ti-eye');
                $(this).parent().parent().find('input').attr('type','text');
            }
        });
    </script>
@endpush