<script type="text/javascript">
    $(function() {
        $('#item').on('change', function() {
            const id = $(this).val();
            // Fetch dari API
            fetch("{{ asset('itemopt/') }}" + "/" + id)
                .then(response => response.json())
                .then(data => {
                    $("#itemid").val(data.itemid);
                    $("#itemname").val(data.itemname);
                    $("#itemcode").val(data.itemcode);
                    $("#itemqty").val(data.itemqty);
                    $("#itemprice").val(data.itemprice);
                });
        });
    });
</script>
