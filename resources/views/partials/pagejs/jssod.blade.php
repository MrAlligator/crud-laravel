<script type="text/javascript">
    $(function() {
        //LOAD ONSTART
        reqItem();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('.js-example-basic-multiple').select2();

        //FUNGSI LOAD SELECT ITEM
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

        //FUNGSI TOMBOL HITUNG/CALCULATE
        $('#btnCalculate').click(function(e) {
            var qty = $('#itemqty').val();
            var price = $('#itemprice').val();
            var discPercentage = $('#disc').val();
            //Validasi Qty
            if (qty == '') {
                alert('Fill the Quantity First');
                return false;
            }
            //Validasi Price
            if (price == '') {
                alert('Price cannot be Null');
                return false;
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

        //ON KLIK TOMBOL SAVE
        $('#btnSave').click(function(e) {
            var item = $('#item').val();
            var qty = $('#itemqty').val();
            var price = $('#itemprice').val();
            var total = $('#total').val();
            var discperc = $('#disc').val();
            var discount = $('#discount').val();
            //Validasi Select
            if (item == 0) {
                alert('Please Select Item First');
                return false;
            }
            //Validasi Qty
            if (qty == '') {
                alert('Quantity cannot be Null');
                return false;
            }
            //Validasi Price
            if (price == '') {
                alert('Price cannot be Null');
                return false;
            }
            //Validasi Total
            if (total == '') {
                alert('Calculate first');
                return false;
            }
            //Validasi discount
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

        //CONFIRM
        $('#btnConfirm').click(function(e) {
            var soNUMBER = $('#sonumber').val();
            e.preventDefault();
            var result = confirm("Confirm " + soNUMBER + "?");
            if (result) {
                $.ajax({
                    type: "POST",
                    url: "{{ asset('') }}confirm/" + soNUMBER,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            } else {
                return false;
            }
        });

        //LOAD DATA TABLES ITEM
        var soNumber = $('#sonumber').val();
        var table = $('.data-table-item').DataTable({
            rowGroup: {
                startRender: null,
                endRender: function(rows, group) {
                    var TotalQty = rows
                        .data()
                        .pluck(3)
                        .reduce(function(a, b) {
                            return a + b;
                        }, 0);
                }
            },
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
                $('#editItemModal').modal('show');
                $('#editItemModalLabel').html("Edit Item");
                $('#updateBtn').html("Save Changes");
                $('#updateBtn').val("edit");
                //SELECT OPTION
                var itemcode = data[0].itemcode;
                let dropdown = document.getElementById('itemlst');
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

                                var array = Object.keys(data).map((key) => [Number(key),
                                    data[key]
                                ]);
                                // console.log(array[0][1][0][1]);

                                let option;

                                for (let i = 0; i < array[0][1][0].length; i++) {
                                    option = document.createElement('option');
                                    option.text = array[0][1][0][i].Item_Name;
                                    option.value = array[0][1][0][i].Item_Code + '^' +
                                        array[0][1][0][i].Item_Name;
                                    if (itemcode == array[0][1][0][i].Item_Code) {
                                        option.selected = true;
                                    }
                                    dropdown.add(option);
                                }
                            });
                        }
                    )
                    .catch(function(err) {
                        console.error('Fetch Error -', err);
                    });
                //LOAD AND SET DATA TO VIEW
                $('#itemqtyEdit').val(data[0].qty);
                $('#itempriceEdit').val(data[0].price);
                $('#discEdit').val(data[0].discperc);
                $('#discountEdit').val(data[0].discount);
                $('#totalEdit').val(data[0].total);
                $('#sonumberEdit').val(data[0].sonumber);
                $('#itemcodeEdit').val(data[0].itemcode);
                $('#noidEdit').val(data[0].noid);
            });
        });

        $('#updateBtn').click(function(e) {
            e.preventDefault();
            $.ajax({
                data: $('#editItemForm').serialize(),
                url: "{{ route('update.sodetail') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#editItemModal').modal('hide');
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        })

        $('#btnreCalculate').click(function(e) {
            var qty = $('#itemqtyEdit').val();
            var price = $('#itempriceEdit').val();
            var discPercentage = $('#discEdit').val();
            //Validasi Qty
            if (qty == '') {
                alert('Fill the Quantity First');
                return false;
            }
            //Validasi Price
            if (price == '') {
                alert('Price cannot be Null');
                return false;
            }
            if (discPercentage == 0 || discPercentage == '') {
                var total = qty * price;
                $('#totalEdit').val(total);
                $('#discountEdit').val(0);
            } else {
                var total = qty * price;
                var discValue = (total * discPercentage) / 100;
                var totalAfterDisc = total - discValue;
                $('#discountEdit').val(discValue);
                $('#totalEdit').val(totalAfterDisc);
            }
        })
    });
</script>
