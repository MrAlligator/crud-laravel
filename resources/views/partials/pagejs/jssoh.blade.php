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
            ajax: "{{ route('soheaderajax.index') }}",
            columns: [{
                    data: 'tanggal',
                    name: 'tanggal'
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

        $('body').on('click', '.editSO', function() {
            var id = $(this).data('id');
            $.get("{{ route('soheaderajax.index') }}" + '/' + id + '/edit', function(data) {
                console.log(data);
                $('#soHeaderModal').modal('show');
                $('#soHeaderModalLabel').html("Edit");
                $('#funcBtn').html("Save Changes");
                $('#funcBtn').val("edit");
                $('#id').val(data.id);
                $('#date').val(data.tangal);
                $('#customer').val(data.customer);
            })
        });

        $('#funcBtn').click(function(e) {
            e.preventDefault();
            $.ajax({
                data: $('#soHeaderForm').serialize(),
                url: "{{ route('soheaderajax.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#soHeaderForm').trigger("reset");
                    $('#soHeaderModal').modal('hide');
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                    if ($('#funcBtn').val() == "save") {
                        alert("Data Gagal Disimpan");
                    } else if ($('#funcBtn').val() == "edit") {
                        alert("Data Gagal Diubah");
                    }
                }
            });
        });

        $('body').on('click', '.deleteSO', function() {
            var id = $(this).data("id");
            var result = confirm("Delete Data?");
            if (result) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('soheaderajax.store') }}" + '/' + id,
                    success: function(data) {
                        alert('Data Removed Succesfully');
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        alert('Data Failed to Remove');
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>
