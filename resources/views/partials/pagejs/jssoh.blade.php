<!-- Page level custom scripts -->
<script type="text/javascript">
    $(function() {

        reqCus();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table-so').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('solist') }}",
            columns: [{
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'sonumber',
                    name: 'sonumber'
                },
                {
                    data: 'accountid',
                    name: 'accountid'
                },
                {
                    data: 'accountname',
                    name: 'accountname'
                },
                {
                    data: 'customer',
                    name: 'customer'
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
            }
            if (customer == 0) {
                alert('Please Choose Customer First');
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

        function reqCus() {
            let dropdown = document.getElementById('accountid');
            dropdown.length = 0;

            let defaultOption = document.createElement('option');
            defaultOption.text = 'Choose Customer';
            defaultOption.value = 0;

            dropdown.add(defaultOption);
            dropdown.selectedIndex = 0;

            const url = 'http://akses.kokola.co.id/api/magnetar/customer.php';

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
    });
</script>
