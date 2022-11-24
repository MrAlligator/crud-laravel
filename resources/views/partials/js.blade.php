<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('vendor/jquery/jquery-ui.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.rowReorder.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.rowGroup.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>

<script>
    $(function() {
        $("#date").datepicker({
            minDate: new Date(),
        });
    });
</script>
