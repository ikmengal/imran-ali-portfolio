@if (Session::has('success'))
   <script>
       toastr.options = {
           "closeButton": true,
           "progressBar": true,
           "timeOut": 5000
       }
       toastr.success("{{ session('success') }}");
       @if (Session::has('generated_password'))
           toastr.info("Generated Password: <strong>{{ session('generated_password') }}</strong> <small>(copy this now)</small>", "Password Generated", { timeOut: 10000, allowHtml: true });
       @endif
   </script>
@endif

@if (Session::has('message'))
   <script>
       toastr.options = {
           "closeButton": true,
           "progressBar": true
       }
       toastr.success("{{ session('message') }}");
   </script>
@endif

@if (Session::has('error'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    </script>
@endif

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

    // function selectInit() {
    //         setTimeout(() => {
    //             $('.select2').each(function() {
    //                 console.log(this);
                    
    //                 $(this).select2({
    //                     dropdownParent: $(this).parent(),
    //                 });
    //             });
    //         }, 1000);
    //     }
</script>
