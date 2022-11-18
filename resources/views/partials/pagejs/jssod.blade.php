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
                    $("#itemprice").val(data.itemprice);
                });
        });

        $('#btnSave').click(function(e){
            e.preventDefault();
            var item = $('#item').val();
            var qty = $('#itemqty').val();
            var price = $('#itemprice').val();
            var discount = $('discount').val();
            if (item == '') {
                alert('Please Select Item First');
            }
            if (qty == '') {
                alert('Quantity cannot be Null');
            }
            if (price == '') {
                alert('Price cannot be Null');
            }
        })
    });
</script>
