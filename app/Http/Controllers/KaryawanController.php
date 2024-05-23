<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\PengajuanCuti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.karyawan.index', [
            'title' => 'Data Pegawai',
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
        $validator = $request->validate([
            'n_depan' => 'required',
            'n_belakang' => 'required',
            'jabatan_id' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $data = [
            'nama' => $request->n_depan . ' ' . $request->n_belakang,
            'email' => $request->n_depan . '@gmail.com',
            'password' => bcrypt($request->n_depan),
            'email_verified_at' => now()
        ];

        $user = User::create($data);
        $user->assignRole('Karyawan');

        $a = User::all()->last();
        $validator['user_id'] = $a->id;

        Karyawan::create($validator);
        return redirect('/dashboard/admin/data-pegawai')->with('success', 'Data Pegawai Berhasil di Tambahkan');
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
    public function update(Request $request,  $id)
    {
        $validator = $request->validate([
            'n_depan' => 'required',
            'n_belakang' => 'required',
            'jabatan_id' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);


        try {
            Karyawan::where('id', $id)->update($validator);
            return redirect('/dashboard/data-pegawai')->with('success', 'Data Pegawai Berhasil di Update');
        } catch (\Exception $e) {
            return redirect('/dashboard/data-pegawai')->with('error', 'Gagal MengUpdate Pegawai. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $user_id = $karyawan->user->id;
        $pengajuanCuti = PengajuanCuti::where('user_id', $user_id)->get();
        try {
            Karyawan::destroy($karyawan->id);
            User::destroy($user_id);
            PengajuanCuti::where('user_id', $user_id)->delete();
            foreach ($pengajuanCuti as $cuti) {
                File::delete('assets/file/pengajuan-cuti/' . $cuti->surat);
            }
            return redirect('/dashboard/data-pegawai')->with('success', 'Data Pegawai Berhasil di Hapus');
        } catch (\Exception $e) {
            return redirect('/dashboard/data-pegawai')->with('error', 'Gagal Menghapus Data Pegawai. Silakan Coba Lagi.');
        }
    }
}
