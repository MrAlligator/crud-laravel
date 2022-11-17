<?php

namespace App\Http\Controllers;

use App\Models\SOHeader;
use App\Models\SOModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;

class SOController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SOHeader::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->soid . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editEmployer">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->soid . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteEmployer">Delete</a>';
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
        // dd(DB::table('s_o_headers')->where('sonumber', $soID)->get());
        return view('content.soDetail', [
            'title' => 'Sales Order',
            'subTitle' => 'Add Detail',
            'active' => 'soh',
            'jsuse' => 'blank',
            'soheader' => DB::table('s_o_headers')->where('sonumber', $soID)->get()
        ]);
    }
}