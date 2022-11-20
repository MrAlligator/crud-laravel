<script type="text/javascript">
    $(function() {
        reqItem();

        function reqItem() {
            var countSOD = {{ $countSOD }};
            if (countSOD != 0) {
                var code = '{{ $sodetail->itemcode }}';
            }

            let dropdown = document.getElementById('item');
            dropdown.length = 0;

            let defaultOption = document.createElement('option');
            defaultOption.text = 'Choose Item';
            defaultOption.value = 0;

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
                                if (countSOD != 0) {
                                    if (code == array[0][1][0][i].Item_Code) {
                                        option.selected = true;
                                    }
                                }
                                dropdown.add(option);
                            }
                        });
                    }
                )
                .catch(function(err) {
                    console.error('Fetch Error -', err);
                });
        }

        $('#btnCalculate').click(function(e) {
            var qty = $('#itemqty').val();
            var price = $('#itemprice').val();
            var discPercentage = $('#disc').val();
            if (qty == '') {
                alert('Fill the Quantity First');
            }
            if (price == '') {
                alert('Price cannot be Null');
            }
            if (discPercentage == 0 || discPercentage == '') {
                var total = qty * price;
                $('#total').val(total);
                $('#discount').val(0);
            } else {
                var total = qty * price;
                var discValue = (total * discPercentage) / 100;
                var totalAfterDisc = total - discValue;
                $('#discount').val(discValue);
                $('#total').val(totalAfterDisc);
            }
        })

        $('#btnSave').click(function(e) {
            var item = $('#item').val();
            var qty = $('#itemqty').val();
            var price = $('#itemprice').val();
            var total = $('#total').val();
            if (item == 0) {
                alert('Please Select Item First');
            }
            if (qty == '') {
                alert('Quantity cannot be Null');
            }
            if (price == '') {
                alert('Price cannot be Null');
            }
            if (total == '') {
                alert('Calculate first');
            }
            e.preventDefault();
            $.ajax({
                data: $('#soDetailForm').serialize(),
                url: "{{ route('save.sodetail') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#soDetailForm').trigger("reset");
                    window.location.href = "{{ route('solist') }}"
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        })
    });
</script>
