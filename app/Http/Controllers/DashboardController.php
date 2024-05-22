<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\PengajuanCuti;
use App\Models\User;
use App\Notifications\StatusPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

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

    public function karyawan()
    {
        return 'hello';
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
        Auth()->user()->unreadNotifications->markAsRead();
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
        $pengajuancuti = PengajuanCuti::findOrFail($id);
        $pengajuancuti->update($validator);
        $pengajuancutiUser = $pengajuancuti->user;
        $Role = Role::where('name', 'Karyawan')->first();

        $karyawan = $Role->users()->where('id', $pengajuancutiUser->id)->first();
        Notification::send($karyawan, new StatusPengajuan($pengajuancuti));
        return redirect('/dashboard/list-pengajuan-cuti')->with('success', 'Pengajuan Cuti ' . $validator['status']);
    }
}
