<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('admin/assets')}}/"
  data-template="vertical-menu-template-no-customizer"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@stack('title') - {{ setting()->name ?? 'Client Onboarding' }}</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    @if (isset(setting()->favicon) && !empty(setting()->favicon))
        <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/settings') }}/{{setting()->favicon}}" />
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/logo/favicon.png') }}" />
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/ext-component-sweet-alerts.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/toastr.min.css?v=0.0.10') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.css') }}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/custom.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{asset('admin/assets/css/fancybox.css')}}" />

    @stack('css')

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/cards-advance.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/page-profile.css') }}" /> -->
    <!-- Helpers -->
    <script src="{{ asset('admin/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/template-customizer.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('admin.layouts.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('admin.layouts.header')
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
                <div class="container-fluid flex-grow-1 container-p-y">
                  @yield('content')
                </div>
            <!-- / Content -->

            <!-- Footer -->
            @include('admin.layouts.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('admin/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('admin/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> {{-- Getting error if i set it to local path. --}}
    <script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/ext-component-sweet-alerts.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('admin/assets/js/fancy-box.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>
    @include('admin.layouts.additional-script')
    <!-- Page JS -->
    <script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/action-gateway.js?v=1.0.13') }}"></script>
    <script src="{{ asset('admin/assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('admin/assets/js/charts-chartjs.js') }}"></script>
    <script src="{{ asset('admin/assets/js/cards-statistics.js') }}"></script>
    @stack('js')
    @stack('modals')
    <script>
        function showFancyBox() {
            $.fancybox.open('<div class="fancybox-loading"></div>', {
                closeExisting: true,
                toolbar: false,
                smallBtn: false,
                modal: false,
                keyboard: false,
                clickSlide: false,
                touch: false,
                caption: 'Please wait while your request is being processed.'
            });
        }

        function hideFancyBox() {
            $.fancybox.close();
        }

        $(document).on("input", ".numeric", function() {
           this.value = this.value.replace(/\D/g, '');
       });

       $('.form-select').each(function() {
           $(this).select2({
               dropdownParent: $(this).parent(),
           });
       });


       $(document).on('keyup', '.cnic_number', function() {
           var cnic = $(this).val();
           var formattedCnic = formatCnic(cnic);
           $(this).val(formattedCnic);
       });

       function formatCnic(cnic) {
           cnic = cnic.replace(/\D/g, ''); // Remove non-numeric characters
           if (cnic.length > 5) {
               cnic = cnic.substring(0, 5) + "-" + cnic.substring(5, 12) + "-" + cnic.substring(12, 13);
           } else if (cnic.length > 2) {
               cnic = cnic.substring(0, 5) + "-" + cnic.substring(5);
           }
           return cnic;
       }
       $(document).on('keyup', '.mobileNumber', function() {
           var mobile = $(this).val();
           var formattedMobile = formatMobileNumber(mobile);
           $(this).val(formattedMobile);
       });

       function formatMobileNumber(mobile) {
           mobile = mobile.replace(/\D/g, ''); // Remove non-numeric characters
           if (mobile.length > 4) {
               mobile = mobile.substring(0, 4) + "-" + mobile.substring(4, 11);
           }
           return mobile;
       }

       $(document).on('keyup', '.phoneNumber', function() {
           var phone = $(this).val();
           var formattedPhone = formatPhoneNumber(phone);
           $(this).val(formattedPhone);
       });

       function formatPhoneNumber(phone) {
          phone = phone.replace(/\D/g, '');
          if (phone.length > 3) {
              var areaCode = phone.substring(0, 3);
              var telephoneNumber = phone.substring(3, 11);
              phone = "(" + areaCode + ") - " + telephoneNumber;
          }
          return phone;
       }

       $('.numberInput').on('input', function () {
          const inputValue = $(this).val();
          const maxLength = 9;

          // Replace non-numeric characters
          this.value = inputValue.replace(/[^0-9]/g, '');

          // Check length dynamically
          if (this.value.length > maxLength) {
              $('#error-message').text('The number must be exactly 9 digits.').show();
          } else {
              $('#error-message').hide();
          }
      });

      $('.fnsNumberInput').on('input', function () {
          const inputValue = $(this).val();
          const maxLength = 7;

          // Replace non-numeric characters
          this.value = inputValue.replace(/[^0-9]/g, '');

          // Check length dynamically
          if (this.value.length > maxLength) {
              $('#error-message').text('The number must be exactly 7 digits.').show();
          } else {
              $('#error-message').hide();
          }
      });
    </script>
  </body>
</html>
