<?php

namespace App\Http\Controllers;

use App\Models\SOHeader;
use App\Http\Requests\StoreSOHeaderRequest;
use App\Http\Requests\UpdateSOHeaderRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SOHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SOHeader::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editSO">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteSO">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('content.soHeader', [
            'title' => 'SO Header',
            'subTitle' => 'Table',
            'active' => 'soh'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSOHeaderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSOHeaderRequest $request)
    {
        SOHeader::updateOrCreate(
            ['id' => $request->id],
            [
                'tanggal' => $request->date,
                'customer' => $request->customer
            ]
        );

        return response()->json(['success' => 'Data Saved.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SOHeader  $sOHeader
     * @return \Illuminate\Http\Response
     */
    public function show(SOHeader $sOHeader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SOHeader  $sOHeader
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $so = SOHeader::find($id);
        return response()->json($so);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSOHeaderRequest  $request
     * @param  \App\Models\SOHeader  $sOHeader
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSOHeaderRequest $request, SOHeader $sOHeader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SOHeader  $sOHeader
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SOHeader::find($id)->delete();
        return response()->json(['success' => 'DataRemoved Succesfully.']);
    }
}