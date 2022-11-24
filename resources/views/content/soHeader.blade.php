@extends('layout.layout')

@section('content')
    <link href="{{ asset('css/floating.css') }}" rel="stylesheet">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="mt-4 mb-4">
            <a data-toggle="modal" id="addData" data-target="#soHeaderModal" type="button" class="btn btn-outline-success">Add
                Data</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data</h6>
                {{-- <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#" data-toggle="modal" id="addData"
                            data-target="#soHeaderModal">Tambah</a>
                    </div>
                </div> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered data-table-so" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SO Date</th>
                                <th>SO Number</th>
                                <th>Account Name</th>
                                <th>Customer</th>
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

    <!-- Modal -->
    <div class="modal fade" id="soHeaderModal" tabindex="-1" aria-labelledby="soHeaderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="soHeaderModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="soHeaderForm" name="soHeaderForm" class="form-signin">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <input type="text" class="form-control" id="sonumberview" name="sonumberview"
                                placeholder="SO********" required readonly>
                            <input type="hidden" id="sonumber" name="sonumber" value="SO{{ $date }}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="date" name="date"
                                placeholder="Open Date">
                            {{-- <input type="date" class="form-control" id="date" name="date" placeholder="Open Date"> --}}
                            {{-- <input type="date" class="form-control" id="date" name="date" min="{{ $date }}" placeholder="Date" required>
                            <label for="date">Date</label> --}}
                        </div>
                        <div class="form-label-group">
                            <select name="regional" id="regional" class="form-control" required>
                            </select>
                        </div>
                        <input type="hidden" id="regcode" name="regcode">
                        <div class="form-label-group">
                            <select name="accountid" id="accountid" class="form-control" required>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="funcBtn"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sendModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="sendModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalContent"></p>
                    <form id="sendForm" name="sendForm">
                        @csrf
                        <input type="hidden" id="sonumberSend" name="sonumberSend">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="sendBtn"></button>
                </div>
            </div>
        </div>
    </div>
@endsection
