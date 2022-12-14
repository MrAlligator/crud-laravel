@extends('layout.layout')

@section('content')
    <link href="css/floating.css" rel="stylesheet">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#" data-toggle="modal" id="addData"
                            data-target="#EmployerModal">Tambah</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Jabatan</th>
                                <th>Departemen</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="EmployerModal" tabindex="-1" aria-labelledby="EmployerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EmployerModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="employerForm" name="employerForm" class="form-signin">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-label-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
                            <label for="name">Nama</label>
                        </div>
                        <div class="form-label-group">
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
                            <label for="nik">NIK</label>
                        </div>
                        <div class="form-label-group">
                            <input type="text" class="form-control" id="position" name="position" placeholder="Jabatan">
                            <label for="position">Jabatan</label>
                        </div>
                        <div class="form-label-group">
                            <input type="text" class="form-control" id="department" name="department" placeholder="Departemen">
                            <label for="department">Departemen</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Alamat"></textarea>
                            {{-- <label for="address">Alamat</label> --}}
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="saveBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
