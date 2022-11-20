<script type="text/javascript">
    $(function() {
        reqItem();

        function reqItem() {
            let dropdown = document.getElementById('item');
            dropdown.length = 0;

            let defaultOption = document.createElement('option');
            defaultOption.text = 'Choose Item';

            dropdown.add(defaultOption);
            dropdown.selectedIndex = 0;

            const url = 'http://akses.kokola.co.id/api/magnetar/item.php';

            fetch(url)
                .then(
                    function(response) {
                        if (response.status !== 200) {
                            console.warn('Looks like there was a problem. Status Code: ' +
                                response.status);
                            return;
                        }
                        response.json().then(function(data) {
                            // console.log(data.Regional_Code);

                            var array = Object.keys(data).map((key) => [Number(key), data[key]]);
                            // console.log(array[0][1][0][1]);

                            let option;

                            for (let i = 0; i < array[0][1][0].length; i++) {
                                option = document.createElement('option');
                                option.text = array[0][1][0][i].Item_Name;
                                option.value = array[0][1][0][i].Item_Code + '^' + array[0][1][0][i]
                                    .Item_Name;
                                dropdown.add(option);
                            }
                        });
                    }
                )
                .catch(function(err) {
                    console.error('Fetch Error -', err);
                });
        }

        $('#btnSave').click(function(e) {
            var item = $('#item').val();
            var qty = $('#itemqty').val();
            var price = $('#itemprice').val();
            if (item == '') {
                alert('Please Select Item First');
            }
            if (qty == '') {
                alert('Quantity cannot be Null');
            }
            if (price == '') {
                alert('Price cannot be Null');
            }
            e.preventDefault();
            $.ajax({
                data: $('#soDetailForm').serialize(),
                url: "{{ route('save.sodetail') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#soDetailForm').trigger("reset");
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        })
    });
</script>
