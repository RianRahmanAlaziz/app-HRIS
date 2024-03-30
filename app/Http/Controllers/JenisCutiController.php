<?php

namespace App\Http\Controllers;

use App\Models\JenisCuti;
use Illuminate\Http\Request;

class JenisCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.jeniscuti.index', [
            'title' => 'Data Jenis Cuti',
            'jeniscuti' => JenisCuti::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'n_cuti' => 'required'
        ]);

        JenisCuti::create($validator);
        return redirect('/dashboard/data-jenis-cuti')->with('success', 'Data Jenis Cuti Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisCuti $jenisCuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisCuti $jenisCuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validator = $request->validate([
            'n_cuti' => 'required'
        ]);


        try {
            JenisCuti::where('id', $id)->update($validator);
            return redirect('/dashboard/data-jenis-cuti')->with('success', 'Data Jenis Cuti Berhasil di Update');
        } catch (\Exception $e) {
            return redirect('/dashboard/data-jenis-cuti')->with('error', 'Gagal MengUpdate Jenis Cuti. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            JenisCuti::destroy($id);
            return redirect('/dashboard/data-jenis-cuti')->with('success', 'Data Jenis Cuti Berhasil di Hapus');
        } catch (\Exception $e) {
            return redirect('/dashboard/data-jenis-cuti')->with('error', 'Gagal menghapus Jenis Cuti. Silakan coba lagi.');
        }
    }
}
