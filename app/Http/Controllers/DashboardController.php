<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\PengajuanCuti;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard', [
            'title' => 'Dashboard',
            'pegawai' => Karyawan::count(),
            'saldo' => Karyawan::where('user_id', Auth()->user()->id)->value('saldo'),
            'list' => PengajuanCuti::where('user_id', Auth()->user()->id)->whereIn('status', ['Pending', 'Accept'])
                ->get()
        ]);
    }

    function listpengajuan()
    {
        Auth()->user()->unreadNotifications->markAsRead();
        return view('dashboard.pengajuancuti.list', [
            'title' => 'List Pengajuan Cuti',
            'list' => PengajuanCuti::where('status', 'Pending')->get()
        ]);
    }

    function riwayatpengajuan()
    {
        return view('dashboard.pengajuancuti.riwayat', [
            'title' => 'Riwayat Pengajuan Cuti',
            'list' => PengajuanCuti::where('user_id', Auth()->user()->id)->get()
        ]);
    }

    public function ubah_status(Request $request, $id)
    {
        $validator = $request->validate([
            'status' => 'required',
            'keterangan' => ''
        ]);

        PengajuanCuti::where('id', $id)->update($validator);
        return redirect('/dashboard/list-pengajuan-cuti')->with('success', 'Pengajuan Cuti ' . $validator['status']);
    }
}
