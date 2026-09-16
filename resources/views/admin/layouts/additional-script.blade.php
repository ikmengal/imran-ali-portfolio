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
