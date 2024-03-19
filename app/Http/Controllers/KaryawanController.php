<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.karyawan.index', [
            'title' => 'Data Karyawan',
            'karyawan' => Karyawan::all(),
            'jabatans' => Jabatan::all()
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
        $data = [
            'nama' => $request->n_depan . ' ' . $request->n_belakang,
            'email' => $request->n_depan . '@gmail.com',
            'level' => $request->jabatan_id,
            'password' => bcrypt($request->n_depan),
            'email_verified_at' => now()
        ];
        dd($data);
        User::create($data);

        $validator = $request->validate([
            'n_depan' => 'required',
            'n_belakang' => 'required',
            'jabatan_id' => 'required',
            'n_hp' => 'required',
            'alamat' => 'required',
        ]);

        $a = User::all()->last();
        $validator['user_id'] = $a->id;

        Karyawan::create($validator);
        return redirect('/dashboard/data-karyawan')->with('success', 'Data Karyawan Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        try {
            Karyawan::destroy($karyawan->id);
            User::destroy($karyawan->user->id);
            return redirect('/dashboard/data-karyawan')->with('success', 'Data Karyawan Berhasil di Hapus');
        } catch (\Exception $e) {
            return redirect('/dashboard/data-karyawan')->with('error', 'Gagal Menghapus Data Karyawan. Silakan Coba Lagi.');
        }
    }
}
