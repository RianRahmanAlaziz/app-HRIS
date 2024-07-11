<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Holiday;
use App\Models\Karyawan;
use App\Models\PengajuanCuti;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Carbon\CarbonPeriod;


class AbsensiController extends Controller
{
    public function location(Request $request)
    {
        $response = Http::get('https://nominatim.openstreetmap.org/reverse?format=geojson&lat=' . $request->lat . '&lon=' . $request->lon);

        return $response->json()['features'][0]['properties']['display_name'];
    }

    public function getIp(Request $request)
    {
        $headersToCheck = array(
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        );

        foreach ($headersToCheck as $header) {
            if ($request->hasHeader($header)) {
                $ips = array_map('trim', explode(',', $request->header($header)));

                foreach ($ips as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                        return $ip;
                    }
                }
            }
        }

        // Jika tidak ditemukan alamat IP yang valid, kembalikan null atau handle secara sesuai dengan kebutuhan aplikasi Anda.
        return null;
    }

    public function index()
    {
        $currentDateTime = Carbon::now()->format('d-M-Y');
        $pegawai = auth()->user()->karyawan;
        $data = [
            'pegawai' => $pegawai,
            'absensi' => null,
            'registered_absensi' => null,
            'title' => 'Absensi',
            'date' => $currentDateTime,
        ];
        $last_absensi = $pegawai->absensi->last();
        if ($last_absensi) {
            if ($last_absensi->created_at->format('d') == Carbon::now()->format('d')) {
                $data['absensi'] = $last_absensi;
                if ($last_absensi->registered)
                    $data['registered_absensi'] = 'yes';
            }
        }
        return view('ui-karyawan.absensi.index', $data);
    }

    public function store(Request $request, $id)
    {
        $jam = Carbon::now()->format('H:i:s');

        $absensi = new Absensi([
            'karyawan_id' => $id,
            'entry_ip' => $request->ip(),
            'entry_time' => $jam,
            'time' => date('h'),
            'entry_location' => $request->entry_location
        ]);


        $absensi->save();
        $currentTime = date('H');
        if ($currentTime > 9) {
            return redirect('/dashboard')->with('success', 'Absensi Anda berhasil direkam sistem dengan catatan keterlambatan');
        } else {
            return redirect('/dashboard')->with('success', 'Absensi Anda berhasil direkam sistem');
        }
    }


    public function update(Request $request, $id)
    {
        $jam = Carbon::now()->format('H:i:s');

        $absensi = Absensi::findOrFail($id);
        $absensi->exit_ip = $request->ip();
        $absensi->exit_time = $jam;
        $absensi->exit_location = $request->exit_location;
        $absensi->registered = 'yes';
        $absensi->save();
        return redirect('/dashboard')->with('success', 'Absensi Anda berhasil diakhiri');
    }

    public function laporan()
    {
        $pegawai = Karyawan::orderBy('n_lengkap')->get();
        $absensi = collect();
        $cuti = collect();
        $namabulan = ["", "January", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember",];
        $filter = false;

        if (request()->filled(['karyawan_id', 'bulan', 'tahun'])) {
            $this->validate(request(), [
                'karyawan_id' => 'required',
                'bulan' => 'required',
                'tahun' => 'required',
            ]);

            $karyawan_id = request()->karyawan_id;
            $bulan = request()->bulan;
            $tahun = request()->tahun;

            $kr = Karyawan::findOrFail($karyawan_id);

            $absensi = Absensi::where('karyawan_id', $karyawan_id)
                ->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->get();

            // Fetch cuti
            $cuti = PengajuanCuti::where('karyawan_id', $karyawan_id)
                ->where('status', 'Accept')
                ->whereMonth('tgl_mulai', '<=', $bulan)
                ->whereMonth('tgl_selesai', '>=', $bulan)
                ->whereYear('tgl_mulai', '<=', $tahun)
                ->whereYear('tgl_selesai', '>=', $tahun)
                ->get();

            $filter = true;
        }
        $todayDate = date('Y');
        $todayMonth = date('n'); // Get current month as number
        $todayMonthName = $namabulan[$todayMonth];

        $data = [
            'pegawai' => $pegawai,
            'title' => 'Laporan Absensi',
            'namabulan' => $namabulan,
            'filter' => $filter,
            'absensi' => $absensi,
            'cuti' => $cuti,
            'todayDate' => $todayDate,
            'todayMonthName' => $todayMonthName,
        ];

        if (isset($kr)) {
            $data['karyawan'] = $kr;
        }

        if (request()->has('cetak')) {

            return view('dashboard.absensi.cetak', $data);
        }

        return view('dashboard.absensi.list', $data);
    }

    public function rekap()
    {
        $absensi = collect();
        $cuti = collect();
        $namabulan = ["", "January", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember",];
        $filter = false;

        if (request()->filled(['bulan', 'tahun'])) {
            $this->validate(request(), [
                'bulan' => 'required',
                'tahun' => 'required',
            ]);

            $bulan = request()->bulan;
            $tahun = request()->tahun;

            $absensi = Absensi::whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->get();

            // Fetch cuti
            $cuti = PengajuanCuti::whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->get();

            $filter = true;
        }
        $employees = Karyawan::all();

        $todayDate = date('Y');
        $todayMonth = date('n'); // Get current month as number
        $todayMonthName = $namabulan[$todayMonth];

        $data = [
            'title' => 'Rekap Absensi',
            'namabulan' => $namabulan,
            'filter' => $filter,
            'absensi' => $absensi,
            'cuti' => $cuti,
            'todayDate' => $todayDate,
            'todayMonthName' => $todayMonthName,
            'employees' => $employees,
        ];



        if (request()->has('cetak')) {

            return view('dashboard.absensi.cetakrekap', $data);
        }

        return view('dashboard.absensi.rekap', $data);
    }
}
