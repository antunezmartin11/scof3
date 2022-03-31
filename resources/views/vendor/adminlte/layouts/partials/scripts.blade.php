<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->

<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="{{ asset('plugins/jquery.dataTables.js') }}"></script>        
<script src="{{ asset('plugins/dataTables.bootstrap.js') }}"></script>        
<script src="{{ asset('js/alertify.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('Validator/js/bootstrapValidator.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('/EasyAutocomplete/jquery.easy-autocomplete.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/sweetalert.min.js')}}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script>
  
$(".select2").select2();


    
</script>