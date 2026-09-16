@extends('auth.master')
@push('title', $title ?? 'Login')
@section('content')
    <!-- Content -->
        <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img
                src="{{ asset('admin/assets/img/illustrations/auth-login-illustration-light.png') }}"
                alt="auth-login-cover"
                class="img-fluid my-5 auth-illustration"
                data-app-light-img="illustrations/auth-login-illustration-light.png"
                data-app-dark-img="illustrations/auth-login-illustration-dark.png"
                />

                <img
                src="{{ asset('admin/assets/img/illustrations/bg-shape-image-light.png') }}"
                alt="auth-login-cover"
                class="platform-bg"
                data-app-light-img="illustrations/bg-shape-image-light.png"
                data-app-dark-img="illustrations/bg-shape-image-dark.png"
                />
            </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
            <div class="w-px-500 mx-auto">
                <!-- Logo -->
                <div class="app-brand mb-4">
                <a href="javascript:;" class="app-brand-link gap-2">
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
                <h3 class="mb-1 fw-bold">Welcome to {{ setting()->name ?? 'Client Onboarding' }} 👋</h3>
                <p class="mb-4">Please sign-in to your account and start the adventure</p>
                <div id="errorMessage"></div>
                <form id="loginForm" class="mb-3" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" @if(isset($_COOKIE["email"])) value="{{ $_COOKIE["email"] }}" @endif name="email" placeholder="Enter your email" autofocus />
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="mb-3 form-password-toggle">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" @if(isset($_COOKIE["password"])) value="{{ $_COOKIE["password"] }}" @endif name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" @if(isset($_COOKIE["email"])) checked @endif >
                        <label class="form-check-label" for="remember"> Remember Me </label>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <span id="login-btn" style="display: none;">
                        <button type="submit" id="loginButton" class="btn btn-primary d-grid w-100">Sign in </button>
                    </span>

                    <div id="loader" style="display: none;">
                        <button type="button" class="btn btn-primary w-100" disabled><span class="spinner-border me-1" role="status" aria-hidden="true"></span>Loading...</button>
                    </div>
                </div>
                </form>
            </div>
            </div>
            <!-- /Login -->
        </div>
        </div>
    <!-- Content -->
@endsection
@push('js')
    <script>
      $(document).ready(function(){
        $('#login-btn').show();
        $('#loginButton').click(function(e){
          e.preventDefault();
            var email = $("#email").val();
            var password = $("#password").val();

            if(email && password){
              $('#login-btn').hide();
              $("#loader").show();
              $("#errorMessage").hide();

              var url = $('#loginForm').attr('action');

              $.ajax({
                type : 'POST',
                url : $('#loginForm').attr('action'),
                data : $('#loginForm').serialize(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                success: function(response){
                  if(response.success == true){
                    window.location.href = response.route;
                  }else{
                    $('#login-btn').show();
                    $("#loader").hide();
                    var message = '<div class="alert alert-danger">' + response.error + '</div>';
                    $("#errorMessage").html(message).show();
                  }
                },
                error: function(xhr){
                  $('#login-btn').show();
                  $("#loader").hide();
                  var message = '';
                  if(xhr.responseJSON && xhr.responseJSON.error) {
                      message = '<div class="alert alert-danger">' + xhr.responseJSON.error + '</div>';
                  } else if(xhr.responseJSON && xhr.responseJSON.message) {
                      message = '<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>';
                  } else {
                      message = '<div class="alert alert-danger">Invalid email & password</div>';
                  }
                  $("#errorMessage").html(message).show();
                }
              });
            }else{
              var message = '<div class="alert alert-danger">Please insert email and password</div>'
              $('#errorMessage').html(message).show();
            }
          });
      });
    </script>
    <script type="text/javascript">
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
