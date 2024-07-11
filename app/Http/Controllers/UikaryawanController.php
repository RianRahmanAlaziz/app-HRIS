<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\PengajuanCuti;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UikaryawanController extends Controller
{
    public function index()
    {
        $hariini = Carbon::today();
        $bulanIni = Carbon::now()->month * 1;
        $tahunIni = Carbon::now()->year;
        $namabulan = ["", "January", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember",];

        $id = auth()->user()->karyawan->id;
        $absensihariini = Absensi::where('karyawan_id', $id)
            ->whereDate('created_at', $hariini)
            ->first();
        $historybulanini = Absensi::where('karyawan_id', $id)
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->get();

        $rekapabsensi = Absensi::where('karyawan_id', $id)
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->selectRaw('COUNT(*) as jmlhadir, SUM(IF(entry_time > "07:00:00", 1, 0)) as jmlterlambat')
            ->first();
        $rekap = PengajuanCuti::where('karyawan_id', $id)
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->selectRaw('SUM(IF(k_cuti = "Sakit", 1, 0)) as jmlsakit')
            ->selectRaw('SUM(IF(k_cuti = "Izin", 1, 0)) as jmlizin')
            ->first();
        return view('ui-karyawan.index', [
            'title' => 'Home',
            'absensihariini' => $absensihariini,
            'historybulanini' => $historybulanini,
            'namabulan' => $namabulan,
            'bulanIni' => $bulanIni,
            'tahunIni' => $tahunIni,
            'rekapabsensi' => $rekapabsensi,
            'rekap' => $rekap
        ]);
    }

    public function userprofil()
    {
        $user = Karyawan::where('user_id', Auth()->user()->id)->first();

        return view('ui-karyawan.user.user-profil', [
            'title' => 'User Profil',
            'user' => $user
        ]);
    }

    public function history()
    {
        $karyawan = Karyawan::where('user_id', Auth()->user()->id)->first();
        $absensi = collect();
        $cuti = collect();
        $namabulan = ["", "January", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember",];

        if (request()->filled(['bulan', 'tahun'])) {
            $this->validate(request(), [
                'bulan' => 'required',
                'tahun' => 'required',
            ]);
            $bulan = request()->bulan;
            $tahun = request()->tahun;

            $absensi = Absensi::where('karyawan_id', $karyawan->id)
                ->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->get();

            // Fetch cuti
            $cuti = PengajuanCuti::where('karyawan_id', $karyawan->id)
                ->where('status', 'Accept')
                ->whereMonth('tgl_mulai', '<=', $bulan)
                ->whereMonth('tgl_selesai', '>=', $bulan)
                ->whereYear('tgl_mulai', '<=', $tahun)
                ->whereYear('tgl_selesai', '>=', $tahun)
                ->get();
        }
        $todayDate = date('Y');
        $todayMonth = date('n'); // Get current month as number
        $todayMonthName = $namabulan[$todayMonth];
        $data = [
            'title' => 'History Absensi',
            'karyawan' => $karyawan,
            'absensi' => $absensi,
            'cuti' => $cuti,
            'namabulan' => $namabulan,
            'todayDate' => $todayDate,
            'todayMonthName' => $todayMonthName,
        ];

        if (request()->has('cetak')) {

            return view('ui-karyawan.absensi.cetak', $data);
        }
        return view('ui-karyawan.absensi.history', $data);
    }

    public function edituserprofil(Request $request)
    {
        // Dapatkan user yang sedang login
        $id = auth()->user()->id;
        $karyawan = Karyawan::where('user_id', $id)->firstOrFail();

        $validatedData = $request->validate([
            'n_lengkap' => 'required|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|max:15',
            'password' => 'nullable|min:2',
            'alamat' => 'required|max:255',
        ]);

        // Hash password jika ada input password baru
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']); // Menghapus password dari array jika tidak diisi
        }
        // Mulai transaksi database
        DB::beginTransaction();
        try {
            $userUpdateData = [
                'nama' => $validatedData['n_lengkap'],
                'email' => $validatedData['email'],
            ];
            if (isset($validatedData['password'])) {
                $userUpdateData['password'] = $validatedData['password'];
            }
            User::where('id', $id)->update($userUpdateData);

            $karyawanUpdateData = [
                'n_lengkap' => $validatedData['n_lengkap'],
                'no_hp' => $validatedData['no_hp'],
                'alamat' => $validatedData['alamat'],
            ];

            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($karyawan->gambar) {
                    File::delete('assets/img/pegawai/' . $karyawan->gambar);
                }
                $gambar = $request->file('gambar');
                $nama_gambar = time() . rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
                $gambar->move('assets/img/pegawai', $nama_gambar);
                $karyawanUpdateData['gambar'] = $nama_gambar;
            }
            Karyawan::where('user_id', $id)->update($karyawanUpdateData);
            // Commit transaksi
            DB::commit();
        } catch (\Throwable $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memperbarui profil: ' . $e->getMessage()]);
        }
        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function pesan()
    {
        return view('ui-karyawan.pesan.index', [
            'title' => 'Pesan',

        ]);
    }

    public function markAsRead()
    {
        Auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['status' => 'success']);
    }
}
