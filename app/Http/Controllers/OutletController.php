<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $data = Outlet::all();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function create()
    {
        $outlet = Outlet::paginate(5);
        return view('page.outlet.index')->with([
            'outlet' => $outlet
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama_outlet' => $request->input('nama_outlet'),
            'alamat' => $request->input('alamat'),
        ];

        Outlet::create($data);
        return response()->json([
            'succes' => "Data Added!"
        ]);
        // return back()->flash('success', 'Data Outlet Sudah ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'nama_outlet' => $request->input('nama_outlet'),
            'alamat' => $request->input('alamat'),
        ];

        $datas = Outlet::findOrFail($id);
        $datas->update($data);
        return response()->json([
            'message_update' => "Data Updated!"
        ]);
        // return back()->with('message_update', 'Data Outlet Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Outlet::findOrFail($id);
        $data->delete();
        return response()->json([
            'message_delete' => "Data Deleted!"
        ]);
        // return back()->with('message_delete', 'Data Outlet Sudah dihapus');
    }
}
