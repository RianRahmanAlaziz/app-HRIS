<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.jabatan.index', [
            'title' => 'Data Jabatan',
            'jabatan' => Jabatan::all()
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
            'n_jabatan' => 'required'
        ]);

        Jabatan::create($validator);
        return redirect('/dashboard/data-jabatan')->with('success', 'Data Jabatan Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validator = $request->validate([
            'n_jabatan' => 'required'
        ]);


        try {
            Jabatan::where('id', $id)->update($validator);
            return redirect('/dashboard/data-jabatan')->with('success', 'Data Jabatan Berhasil di Update');
        } catch (\Exception $e) {
            return redirect('/dashboard/data-jabatan')->with('error', 'Gagal MengUpdate jabatan. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Jabatan::destroy($id);
            return redirect('/dashboard/data-jabatan')->with('success', 'Data Jabatan Berhasil di Hapus');
        } catch (\Exception $e) {
            return redirect('/dashboard/data-jabatan')->with('error', 'Gagal menghapus jabatan. Silakan coba lagi.');
        }
    }
}
