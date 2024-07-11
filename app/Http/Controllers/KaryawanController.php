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
    public function index(Request $request)
    {
        $query = Karyawan::query();
        // Menambahkan logika pencarian berdasarkan nama
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('n_lengkap', 'like', "%{$search}%");
        }

        return view('dashboard.karyawan.index', [
            'title' => 'Data Pegawai',
            'karyawan' => $query->paginate(10)->appends(['search' => $request->input('search')]),
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
            'n_lengkap' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp',
            'jabatan_id' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $data = [
            'nama' => $request->n_lengkap,
            'email' => $request->email,
            'password' => bcrypt('112233'),
            'email_verified_at' => now()
        ];

        $user = User::create($data);
        $user->assignRole('Karyawan');

        $a = User::all()->last();
        $validator['user_id'] = $a->id;

        if ($request->has('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('assets/img/pegawai', $nama_gambar);
            $validator['gambar'] = $nama_gambar;
        }
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
        $karyawan = Karyawan::findOrFail($id);
        $validator = $request->validate([
            'n_lengkap' => 'required',
            'jabatan_id' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);


        try {
            if ($request->has('gambar')) {
                File::delete('assets/img/pegawai/' . $karyawan->gambar);

                $gambar = $request->file('gambar');
                $nama_gambar = time() . rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
                $gambar->move('assets/img/pegawai', $nama_gambar);
                $validator['gambar'] = $nama_gambar;
            } else {
                unset($validator['gambar']);
            }
            Karyawan::where('id', $id)->update($validator);
            return redirect('/dashboard/admin/data-pegawai')->with('success', 'Data Pegawai Berhasil di Update');
        } catch (\Exception $e) {
            return redirect('/dashboard/admin/data-pegawai')->with('error', 'Gagal MengUpdate Pegawai. Silakan coba lagi.');
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
            File::delete('assets/img/pegawai/' . $karyawan->gambar);
            return redirect('/dashboard/admin/data-pegawai')->with('success', 'Data Pegawai Berhasil di Hapus');
        } catch (\Exception $e) {
            return redirect('/dashboard/admin/data-pegawai')->with('error', 'Gagal Menghapus Data Pegawai. Silakan Coba Lagi.');
        }
    }
}
