<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UikaryawanController extends Controller
{
    public function index()
    {
        $hariini = Carbon::today();
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $id = auth()->user()->karyawan->id;
        $absensihariini = Absensi::where('karyawan_id', $id)
            ->whereDate('created_at', $hariini)
            ->first();
        $historybulanini = Absensi::where('karyawan_id', $id)
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->get();

        return view('ui-karyawan.index', [
            'title' => 'Home',
            'absensihariini' => $absensihariini,
            'historybulanini' => $historybulanini
        ]);
    }
}
