@extends('auth.master')
@push('title', 'Register')

@section('content')
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img
                    src="{{ asset('admin/assets/img/illustrations/auth-register-illustration-light.png') }}"
                    alt="auth-register-cover"
                    class="img-fluid my-5 auth-illustration"
                    data-app-light-img="illustrations/auth-register-illustration-light.png"
                    data-app-dark-img="illustrations/auth-register-illustration-dark.png"
                    />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Register -->
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
                    <h3 class="mb-1 fw-bold">Create Account on {{ setting()->name ?? 'Admin Panel' }} 👋</h3>
                    <p class="mb-4">Fill in the details to create your account</p>

                    @if ($errors->any())
                        <div id="errorMessage" class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form id="registerForm" class="mb-3" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required autofocus />
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required />
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
                            <button type="submit" class="btn btn-primary d-grid w-100">Register</button>
                        </div>
                    </form>
                    <p class="text-center mt-4">
                        Already have an account?
                        <a href="{{ route('login') }}" class="fw-medium text-primary"> Sign in</a>
                    </p>
                </div>
            </div>
            <!-- /Register -->
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