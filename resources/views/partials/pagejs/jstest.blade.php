<!-- Page level custom scripts -->
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ajaxemployee.index') }}",
            columns: [{
                    data: 'employerName',
                    name: 'employerName'
                },
                {
                    data: 'employerNIK',
                    name: 'employerNIK'
                },
                {
                    data: 'employerPosition',
                    name: 'employerPosition'
                },
                {
                    data: 'employerDepartment',
                    name: 'employerDepartment'
                },
                {
                    data: 'employerAddress',
                    name: 'employerAddress'
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
            $('#EmployerModalLabel').html("Tambah");
            $('#employerForm').trigger("reset");
            $('#id').val('');
            $('#saveBtn').html("Simpan Data");
            $('#saveBtn').val("save");
        });

        $('body').on('click', '.editEmployer', function() {
            var id = $(this).data('id');
            $.get("{{ route('ajaxemployee.index') }}" + '/' + id + '/edit', function(data) {
                console.log(data);
                $('#EmployerModal').modal('show');
                $('#EmployerModalLabel').html("Edit");
                $('#saveBtn').html("Simpan Perubahan");
                $('#saveBtn').val("edit");
                $('#id').val(data.id);
                $('#name').val(data.employerName);
                $('#nik').val(data.employerNIK);
                $('#position').val(data.employerPosition);
                $('#department').val(data.employerDepartment);
                $('#address').val(data.employerAddress);
            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $.ajax({
                data: $('#employerForm').serialize(),
                url: "{{ route('ajaxemployee.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#employerForm').trigger("reset");
                    $('#EmployerModal').modal('hide');
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                    if ($('#saveBtn').val() == "save") {
                        alert("Data Gagal Disimpan");
                    } else if ($('#saveBtn').val() == "edit") {
                        alert("Data Gagal Diubah");
                    }
                }
            });
        });

        $('body').on('click', '.deleteEmployer', function() {
            var id = $(this).data("id");
            var result = confirm("Yakin hapus data?");
            if (result) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('ajaxemployee.store') }}" + '/' + id,
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
    });
</script>