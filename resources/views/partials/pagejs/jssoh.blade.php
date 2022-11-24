<!-- Page level custom scripts -->
<script type="text/javascript">
    $(function() {
        reqRegional();

        $('#regional').change(function() {
            $('#regcode').val($(this).val());
            reqCus();
        }).change();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table-so').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('solist') }}",
            columns: [{
                    data: 'tanggal',
                    name: 'tanggal',
                    searchable: true
                },
                {
                    data: 'sonumber',
                    name: 'sonumber',
                    searchable: true
                },
                {
                    data: 'accountname',
                    name: 'accountname',
                    searchable: true
                },
                {
                    data: 'customer',
                    name: 'customer',
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#addData').click(function() {
            $('#soHeaderModalLabel').html("Tambah");
            $('#soHeaderForm').trigger("reset");
            $('#id').val('');
            $('#funcBtn').html("Save");
            $('#funcBtn').val("save");
        });

        $('#funcBtn').click(function(e) {
            var date = $('#date').val();
            var customer = $('#accountid').val();
            var soID = $('#sonumber').val();
            if (date == '') {
                alert('Please Choose Date First');
                return false;
            }
            if (customer == 0) {
                alert('Please Choose Customer First');
                return false;
            }
            e.preventDefault();
            $.ajax({
                data: $('#soHeaderForm').serialize(),
                url: "{{ route('save.soheader') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#soHeaderForm').trigger("reset");
                    $('#soHeaderModal').modal('hide');
                    window.location = "addsodetail/" + soID + "/add";
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });

        function reqRegional() {
            let dropdown = document.getElementById('regional');
            dropdown.length = 0;

            let defaultOption = document.createElement('option');
            defaultOption.text = 'Choose Regional';
            defaultOption.value = 0;

            dropdown.add(defaultOption);
            dropdown.selectedIndex = 0;

            const url = 'http://akses.kokola.co.id/api/magnetar/regional.php';

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
                            // console.log(array[0][1]);

                            let option;

                            for (let i = 0; i < array[0][1].length; i++) {
                                option = document.createElement('option');
                                option.text = array[0][1][i].Regional_Desc;
                                option.value = array[0][1][i].Regional_Code;
                                dropdown.add(option);
                            }
                        });
                    }
                )
                .catch(function(err) {
                    console.error('Fetch Error -', err);
                });
        }

        function reqCus() {
            let dropdown = document.getElementById('accountid');
            dropdown.length = 0;

            let defaultOption = document.createElement('option');
            defaultOption.text = 'Choose Customer';
            defaultOption.value = 0;

            dropdown.add(defaultOption);
            dropdown.selectedIndex = 0;

            var regional = $('#regcode').val();
            const url = 'http://akses.kokola.co.id/api/magnetar/customer.php?regional=' + regional;
            console.log(url);

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
                            // console.log(array[0][1]);

                            let option;

                            for (let i = 0; i < array[0][1].length; i++) {
                                option = document.createElement('option');
                                option.text = array[0][1][i].Account_Name;
                                option.value = array[0][1][i].Account_Id + '^' + array[0][1][i]
                                    .Account_Name + '^' + array[0][1][i].Sales_Person;
                                dropdown.add(option);
                            }
                        });
                    }
                )
                .catch(function(err) {
                    console.error('Fetch Error -', err);
                });
        }

        $('body').on('click', '.sending', function() {
            var sendsonumber = $(this).data('id');
            var url = "{{ asset('') }}showsend/" + sendsonumber;
            console.log(url);
            $.get(url, function(data) {
                $('#sendModal').modal('show');
                $('#sendModalLabel').html('Send SO');
                $('#sendBtn').html('Send SO');
                $('#modalContent').html('Send This SO?');
                console.log(data);
                for (let i = 0; i < data.length; i++) {
                    var sendAccId = data[i].accountid;
                    var sendAccName = data[i].accountname;
                    var sendDisc = data[i].discount;
                    var sendDiscPerc = data[i].discperc;
                    var sendItemCode = data[i].itemcode;
                    var sendItemName = data[i].itemname;
                    var sendNoId = data[i].noid;
                    var sendPrice = data[i].price;
                    var sendQty = data[i].qty;
                    var sendSoId = data[i].soid;
                    var sendSONumber = data[i].sonumber;
                    var sendDate = data[i].tanggal;
                    var sendTotal = data[i].total;
                    var url2 = "http://akses.kokola.co.id/api/magnetar/senddata.php?sonumber=" +
                        sendSONumber + "&itemcode=" + sendItemCode;
                    console.log(url2);
                }
            });
        });
    });
</script>
