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
use Illuminate\Support\Facades\Http;

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
            'jsuse' => 'jssoh'
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
        $item = $request->item;
        $iteminput = explode('^', $item);
        $itemcode = $iteminput[0];
        $itemname = $iteminput[1];
        SODetail::create(
            [
                'soid' => $request->soid,
                'itemid' => 1,
                'itemcode' => $itemcode,
                'itemname' => $itemname,
                'qty' => $request->itemqty,
                'price' => $request->itemprice,
                'discount' => $request->discount,
                'total' => $request->total,
            ]
        );

        return response()->json(['success' => 'Successfully Save Data.']);
    }
}
