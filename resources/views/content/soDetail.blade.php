@extends('layout.layout')

@section('content')
    <link href="{{ asset('css/floating.css') }}" rel="stylesheet">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row justify-content-lg-start">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Add SO Detail</h6>
                    </div>
                    <div class="card-body">
                        <form>
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
                                        <label for="item">Select Item</label>
                                        <select name="item" id="item" class="form-control">
                                            <option value="" selected disabled>Select an Item</option>
                                            @foreach ($itemopt as $opt)
                                                <option value="{{ $opt->itemid }}">{{ $opt->itemcode }} || {{ $opt->itemname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <input type="hidden" name="itemid" id="itemid">
                                    <input type="hidden" name="itemname" id="itemname">
                                    <input type="hidden" name="itemcode" id="itemcode">
                                    <div class="form-group">
                                        <label for="itemqty">Quatity</label>
                                        <input type="text" class="form-control" id="itemqty" name="itemqty"
                                            placeholder="Quatity" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="itemprice">Price</label>
                                        <input type="text" class="form-control" id="itemprice" name="itemprice"
                                            placeholder="Price" readonly>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
