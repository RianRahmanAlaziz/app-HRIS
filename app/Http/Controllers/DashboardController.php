<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\PengajuanCuti;
use App\Models\User;
use App\Notifications\StatusPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini = Carbon::today();
        $rekapabsensi = Absensi::whereDate('created_at', $hariini)
            ->selectRaw('COUNT(*) as jmlhadir, SUM(IF(entry_time > "08:00:00", 1, 0)) as jmlterlambat')
            ->first();
        $rekap = PengajuanCuti::where('status', 'Accept')
            ->where(function ($query) use ($hariini) {
                $query->whereDate('tgl_mulai', '<=', $hariini)
                    ->whereDate('tgl_selesai', '>=', $hariini);
            })
            ->selectRaw('SUM(IF(k_cuti = "Sakit", 1, 0)) as jmlsakit')
            ->selectRaw('SUM(IF(k_cuti = "Izin", 1, 0)) as jmlizin')
            ->first();
        return view('dashboard.dashboard', [
            'title' => 'Dashboard',
            'pegawai' => Karyawan::count(),
            'rekap' => $rekapabsensi,
            'rekapizin' => $rekap,
            'saldo' => Karyawan::where('user_id', Auth()->user()->id)->value('saldo'),

        ]);
    }


    function listpengajuan()
    {
        Auth()->user()->unreadNotifications->markAsRead();
        return view('dashboard.pengajuancuti.list', [
            'title' => 'Daftar Pengajuan Cuti',
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
        $pengajuancutiUser = $pengajuancuti->karyawan;

        $Role = Role::where('name', 'Karyawan')->first();

        $karyawan = $Role->users()->where('id', $pengajuancutiUser->user_id)->first();

        Notification::send($karyawan, new StatusPengajuan($pengajuancuti));
        return redirect('/dashboard/admin/list-pengajuan-cuti')->with('success', 'Pengajuan Cuti ' . $validator['status']);
    }
}
