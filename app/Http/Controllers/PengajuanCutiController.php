<?php

namespace App\Http\Controllers;

use App\Models\JenisCuti;
use App\Models\Karyawan;
use App\Models\PengajuanCuti;
use App\Models\User;
use App\Notifications\PengajuanCuti as NotificationsPengajuanCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class PengajuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ui-karyawan.pengajuan.index', [
            'title' => 'Data Pengajuan Cuti/Izin',
            'jcuti' => JenisCuti::all(),
            'list' => PengajuanCuti::where('user_id', Auth()->user()->id)->get()
        ]);
    }

    public function unduh($nama_file)
    {
        return response()->download($nama_file);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ui-karyawan.pengajuan.add', [
            'title' => 'Pengajuan Cuti/Izin',
            'jcuti' => JenisCuti::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $karyawan = Karyawan::where('user_id', $user_id)->firstOrFail();
        $saldocuti = $karyawan->saldo;

        if ($saldocuti <= 0) {
            return redirect('/dashboard/pengajuan-cuti')->with('error', 'Saldo Cuti Tidak Mencukupi');
        }

        // Kurangi saldo cuti sebelum memperbarui data karyawan
        $karyawan->saldo--;

        // Simpan perubahan saldo cuti pada data karyawan
        $karyawan->save();

        $validator = $request->validate([
            'jeniscuti_id' => 'required',
            'k_cuti' => 'required',
            'catatan' => 'required',
            'surat' => 'required|mimes:pdf,docx,doc',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required'
        ]);

        if ($request->has('surat')) {
            $surat = $request->file('surat');
            $nama_surat = time() . rand(1, 9) . '.' . $surat->getClientOriginalExtension();
            $surat->move('assets/file/pengajuan-cuti', $nama_surat);
            $validator['surat'] = $nama_surat;
        }
        $validator['status'] = 'Pending';
        $validator['user_id'] = auth()->user()->id;

        $pengajuancuti = PengajuanCuti::create($validator);
        $adminRole = Role::where('name', 'HRD')->first();
        $admins = $adminRole->users()->get();
        Notification::send($admins, new NotificationsPengajuanCuti($pengajuancuti));
        return redirect('/dashboard/pengajuan-cuti')->with('success', 'Pengajuan Cuti Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanCuti $pengajuanCuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanCuti $pengajuanCuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanCuti $pengajuanCuti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanCuti $pengajuanCuti)
    {
        //
    }
}
