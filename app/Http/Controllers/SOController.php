<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Items;
use App\Models\SODetail;
use App\Models\SOHeader;
use App\Models\SOModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
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
                    $btn = '<a href="addsodetail/' . $row->sonumber . '/edit" target="_blank" data-original-title="Edit" class="edit btn btn-primary btn-sm"><i class="fas fa-fw fa-folder-open"></i></a>';
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
            'date' => strtotime(Carbon::now()),
            'countThisMonth' => SOHeader::whereMonth('created_at', date('m'))->count(),
        ]);
    }

    public function saveSOHeader(Request $request)
    {
        $cust = $request->accountid;
        $custArray = explode('^', $cust);
        $accountid = $custArray[0];
        $accountname = $custArray[1];
        $customer = $custArray[2];
        SOHeader::create([
            'tanggal' => $request->date,
            'accountid' => $accountid,
            'sonumber' => $request->sonumber,
            'accountname' => $accountname,
            'customer' => $customer,
        ]);

        return response()->json(['success' => 'Successfully Save Data.']);
    }

    public function addSODetail($soID)
    {
        $check = SODetail::where('sonumber', $soID)->count();
        $data['title'] = 'Sales Order';
        $data['subTitle'] = 'Add Detail';
        $data['active'] = 'soh';
        $data['jsuse'] = 'jssod';
        $data['soheader'] = SOHeader::where('sonumber', $soID)->first();
        $data['sodetail'] = SODetail::where('sonumber', $soID)->first();
        $data['countSOD'] = $check;
        return view('content.soDetail', $data);
    }

    public function saveSODetail(Request $request)
    {
        $item = $request->item;
        $iteminput = explode('^', $item);
        $itemcode = $iteminput[0];
        $itemname = $iteminput[1];
        SODetail::create([
            'sonumber' => $request->sonumber,
            'soid' => $request->soid,
            'itemid' => 1,
            'itemcode' => $itemcode,
            'itemname' => $itemname,
            'qty' => $request->itemqty,
            'price' => $request->itemprice,
            'discount' => $request->discount,
            'discperc' => $request->disc,
            'total' => $request->total,
        ]);

        return response()->json(['success' => 'Successfully Save Data.']);
    }
}
