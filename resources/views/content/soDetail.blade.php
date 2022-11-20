@extends('layout.layout')

@section('content')
    <link href="{{ asset('css/floating.css') }}" rel="stylesheet">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row justify-content-lg-start">
            <div class="col-lg">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Add SO Detail</h6>
                    </div>
                    <div class="card-body">
                        <form id="soDetailForm">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" name="soid" id="soid" value="{{ $soheader->soid }}">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control" id="sonumber" name="sonumber"
                                            placeholder="SO Number" value="{{ $soheader->sonumber }}" readonly>
                                        <label for="sonumber">SO Number</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" class="form-control" id="accountname" name="accountname"
                                            placeholder="Account Name" value="{{ $soheader->accountname }}" readonly>
                                        <label for="accountname">Account Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control" id="sodate" name="sodate"
                                            placeholder="Date" value="{{ date('d-m-Y', strtotime($soheader->tanggal)) }}"
                                            readonly>
                                        <label for="sodate">Open Date</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" class="form-control" id="customer" name="customer"
                                            placeholder="Customer" value="{{ $soheader->customer }}" readonly>
                                        <label for="customer">Customer</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select name="item" id="item" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-7"></div>
                                <div class="col-lg-3">
                                    <label class="col-form-label">Quantity</label>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control number" id="itemqty" name="itemqty"
                                            @if ($countSOD != 0) value="{{ $sodetail->qty }}" @endif
                                            placeholder="0" onkeypress="return hanyaAngka(event)" required>
                                    </div>
                                </div>
                                <div class="col-lg-7"></div>
                                <div class="col-lg-2">
                                    <label class="col-form-label">Price</label>
                                </div>
                                <div class="col-lg-1">
                                    <label class="col-form-label">Rp.</label>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control number" id="itemprice" name="itemprice"
                                            @if ($countSOD != 0) value="{{ $sodetail->price }}" @endif
                                            placeholder="0" onkeypress="return hanyaAngka(event)" required>
                                    </div>
                                </div>
                                <div class="col-lg-7"></div>
                                <div class="col-lg-2">
                                    <label class="col-form-label">Discount (%)</label>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="disc" name="disc"
                                            @if ($countSOD != 0) value="{{ $sodetail->discperc }}" @endif
                                            placeholder="0" onkeypress="return hanyaAngka(event)" required>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control-plaintext number" id="discount"
                                            name="discount"
                                            @if ($countSOD != 0) value="{{ $sodetail->discount }}" @endif
                                            placeholder="0" onkeypress="return hanyaAngka(event)" required readonly>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            id="btnCalculate">Calculate</button>
                                    </div>
                                </div>
                                <div class="col-lg-7"></div>
                                <div class="col-lg-2">
                                    <label class="col-form-label">Total</label>
                                </div>
                                <div class="col-lg-1">
                                    <label class="col-form-label">Rp.</label>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control-plaintext number" id="total"
                                            @if ($countSOD != 0) value="{{ $sodetail->total }}" @endif
                                            name="total" placeholder="0" onkeypress="return hanyaAngka(event)" required
                                            readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-outline-danger form-control"
                                            id="btnCancel">Cancel</button>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-outline-primary form-control"
                                            id="btnSave">Save</button>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-outline-success form-control"
                                            id="btnConfirm">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
