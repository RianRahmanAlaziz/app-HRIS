<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
        return view('dashboard.absensi.index', $data);
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
    public function store(Request $request, $id)
    {
        $absensi = new Absensi([
            'karyawan_id' => $id,
            'entry_ip' => $request->ip(),
            'time' => date('h'),
            'entry_location' => $request->entry_location
        ]);

        $absensi->save();
        $currentTime = date('H');
        if ($currentTime > 9) {
            return redirect('/dashboard/absensi')->with('success', 'Absensi Anda berhasil direkam sistem dengan catatan keterlambatan');
        } else {
            return redirect('/dashboard/absensi')->with('success', 'Absensi Anda berhasil direkam sistem');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->exit_ip = $request->ip();
        $absensi->exit_location = $request->exit_location;
        $absensi->registered = 'yes';
        $absensi->save();
        return redirect('/dashboard/absensi')->with('success', 'Absensi Anda berhasil diakhiri');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
