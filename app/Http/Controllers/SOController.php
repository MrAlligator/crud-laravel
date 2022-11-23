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
                    $check = SODetail::where('sonumber', $row->sonumber)->count();
                    $btn = '<a href="addsodetail/' . $row->sonumber . '/add" target="_blank" data-original-title="Edit" class="edit btn btn-primary btn-sm"><i class="fas fa-fw fa-folder-open"></i></a>';
                    if ($check != 0) {
                        $btn = $btn . ' <a data-original-title="Send" data-id="' . $row->itemcode . '" class="sending btn btn-success btn-sm"><i class="fas fa-fw fa-paper-plane"></i></a>';
                    } else {
                        $btn = $btn . ' <a data-original-title="Send" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-paper-plane"></i></a>';
                    }
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
        $valdate = $request->date;
        $date = Carbon::parse($valdate)->format('Y-m-d');
        SOHeader::create([
            'tanggal' => $date,
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
        $discperc = $request->disc;
        if ($discperc == '') {
            $discperc = 0;
        }
        SODetail::create([
            'sonumber' => $request->sonumber,
            'soid' => $request->soid,
            'itemcode' => $itemcode,
            'itemname' => $itemname,
            'qty' => $request->itemqty,
            'price' => $request->itemprice,
            'discount' => $request->discount,
            'discperc' => $discperc,
            'total' => $request->total,
        ]);

        return response()->json(['success' => 'Successfully Save Data.']);
    }

    public function updateSODetail(Request $request)
    {
        $item = $request->itemlst;
        $iteminput = explode('^', $item);
        $itemcode = $iteminput[0];
        $itemname = $iteminput[1];
        $discperc = $request->discEdit;
        if ($discperc == '') {
            $discperc = 0;
        }
        // dd($request->noid);
        SODetail::where('noid', $request->noidEdit)->update([
            'itemcode' => $itemcode,
            'itemname' => $itemname,
            'qty' => $request->itemqtyEdit,
            'price' => $request->itempriceEdit,
            'discount' => $request->discountEdit,
            'discperc' => $discperc,
            'total' => $request->totalEdit,
        ]);

        return response()->json(['success' => 'Successfully Update Data.']);
    }

    public function itemIndex(Request $request, $soID)
    {
        if ($request->ajax()) {
            $data = SODetail::where('sonumber', $soID)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<btn href="#" data-id="' . $row->itemcode . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem"><i class="fas fa-fw fa-folder-open"></i></btn>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function showItem($soNumber, $itemCode)
    {
        $parameters = ['itemcode' => $itemCode, 'sonumber' => $soNumber];
        $item = SODetail::where($parameters)->get();
        return response()->json($item);
    }
}
