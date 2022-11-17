<!-- Page level custom scripts -->
<script type="text/javascript">
    $(function() {
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

        $('#accountid').on('change', function() {
            const id = $(this).val();
            // Fetch dari API
            fetch("accopt/" + id + "/show")
                .then(response => response.json())
                .then(data => {
                    $("#accountName").val(data.accountname);
                });
        });
    });
</script>
