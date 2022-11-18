<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Items;
use App\Models\SODetail;
use App\Models\SOHeader;
use App\Models\SOModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use \Yajra\DataTables\Facades\DataTables;

class SOController extends Controller
{
    public function index(Request $request)
    {
        // dd(DB::connection('sqlsrv')->getDatabaseName());
        if ($request->ajax()) {
            $data = SOHeader::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="addsodetail/' . $row->sonumber . '/edit" data-original-title="Edit" class="edit btn btn-primary btn-sm"><i class="fas fa-fw fa-folder-open"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('content.soHeader', [
            'title' => 'Sales Order',
            'subTitle' => 'List',
            'active' => 'soh',
            'jsuse' => 'jssoh',
            'accountopt' => Account::all()
        ]);
    }

    public function saveSOHeader(Request $request)
    {
        SOHeader::create(
            [
                'tanggal' => $request->date,
                'accountid' => $request->accountid,
                'sonumber' => $request->sonumber,
                'accountname' => $request->accountName,
                'customer' => $request->customer
            ]
        );

        return response()->json(['success' => 'Successfully Save Data.']);
    }

    public function addSODetail($soID)
    {
        return view('content.soDetail', [
            'title' => 'Sales Order',
            'subTitle' => 'Add Detail',
            'active' => 'soh',
            'jsuse' => 'jssod',
            'soheader' => SOHeader::where('sonumber', $soID)->first(),
            'itemopt' => Items::all()
        ]);
    }

    public function saveSODetail(Request $request)
    {
        SODetail::create(
            [
                'tanggal' => $request->date,
                'accountid' => $request->accountid,
                'sonumber' => $request->sonumber,
                'accountname' => $request->accountName,
                'customer' => $request->customer
            ]
        );

        return response()->json(['success' => 'Successfully Save Data.']);
    }
}
