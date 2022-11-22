<script type="text/javascript">
    $(function() {
        reqItem();

        // $('.js-example-basic-multiple').select2();

        function reqItem() {
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
            var discperc = $('#disc').val();
            var discount = $('#discount').val();
            if (item == 0) {
                alert('Please Select Item First');
                return false;
            }
            if (qty == '') {
                alert('Quantity cannot be Null');
                return false;
            }
            if (price == '') {
                alert('Price cannot be Null');
                return false;
            }
            if (total == '') {
                alert('Calculate first');
                return false;
            }
            if (discperc != '' && discount == 0) {
                alert('Calculate first');
                return false;
            }
            e.preventDefault();
            $.ajax({
                data: $('#soDetailForm').serialize(),
                url: "{{ route('save.sodetail') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#soDetailForm').trigger("reset");
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        })

        var soNumber = $('#sonumber').val();
        var table = $('.data-table-item').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "/itemlist/" + soNumber,
            columns: [{
                    data: 'itemcode',
                    name: 'itemcode'
                },
                {
                    data: 'itemname',
                    name: 'itemname'
                },
                {
                    data: 'qty',
                    name: 'qty'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('body').on('click', '.editItem', function() {
            var itemcode = $(this).data('id');
            var url = "{{ asset('') }}detailitem/" + soNumber + "/" + itemcode;
            $.get(url, function(data) {
                console.log(data);
                $('#editItemModal').modal('show');
                $('#editItemModalLabel').html("Edit Item");
                $('#updateBtn').html("Save Changes");
                $('#updateBtn').val("edit");
            });
        });
    });
</script>
