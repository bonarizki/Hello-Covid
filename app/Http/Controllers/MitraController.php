<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MitraRs;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(MitraRs::all())
            ->addIndexColumn()
            ->make(true);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            "created_by" => Auth::user()->name,
            "created_at" => Carbon::now(),
            "updated_by" => Auth::user()->name,
            "updated_at" => Carbon::now()
        ]);

        MitraRs::create($request->except('_token'));

        return response()->json([
            "message" => "success",
            "data" => [
                "message" => "Mitra Added"
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MitraRs::find($id);
        return response()->json(["data" => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        MitraRs::find($request->id_mitra)->update($request->except('_token'));
        return response()->json([
            "message" => "success",
            "data" => [
                "message" => "Mitra Updated"
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        MitraRs::find($request->id_mitra)->delete();
        return response()->json([
            "message" => "success",
            "data" => [
                "message" => "Mitra Deleted"
            ]
        ]);
    }
}
