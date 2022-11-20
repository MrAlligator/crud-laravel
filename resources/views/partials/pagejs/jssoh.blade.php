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
            var soID = $('#sonumber').val();
            e.preventDefault();
            $.ajax({
                data: $('#soHeaderForm').serialize(),
                url: "{{ route('save.soheader') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#soHeaderForm').trigger("reset");
                    $('#soHeaderModal').modal('hide');
                    window.location = "addsodetail/" + soID + "/edit";
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
                                option.value = array[0][1][i].Account_Id;
                                dropdown.add(option);
                            }
                        });
                    }
                )
                .catch(function(err) {
                    console.error('Fetch Error -', err);
                });
        }

        // function reqCus() {
        //     fetch(apiCustomer, {
        //             method: "get"
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             let allcustomers = data.result;
        //             let html = '';
        //             for (var i = 0; i < data.result.length; i++) {
        //                 html += "<option value=" + allcustomers[i].slug + ">" + allcustomers[i].name +
        //                     "</option>"
        //             }
        //             document.getElementById("accountid").innerHTML = html;
        //         })
        // }

        // reqCus();

        $('#accountid').on('change', function() {
            const id = $(this).val();
            // Fetch dari API
            fetch("http://akses.kokola.co.id/api/magnetar/customer.php")
                .then(response => response.json())
                .then(data => {
                    $("#accountName").val(data.accountname);
                    $("#customer").val(data.accountname);
                });
        });
    });
</script>
