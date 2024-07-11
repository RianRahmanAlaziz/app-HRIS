<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        .title {
            font-size: 18px;
            font-weight: bold
        }

        .garis1 {
            border-collapse: collapse;

            border-bottom: 2px solid black;
        }

        .tbl {
            border-collapse: collapse
        }

        .tbz {
            border-collapse: collapse
        }

        .tbl td {
            text-align: center;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4 landscape">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        <table class="tbl" style="width: 100%">
            <tr>
                <td style="width:30px">
                    <img id="logo" src="/assets/img/logo.png" width="80" height="80" />
                </td>
                <td>
                    <span class="title">
                        LAPORAN ABSENSI KARYAWAN <br>
                        PERIODE {{ strtoupper($todayMonthName) }} {{ $todayDate }} <br>
                        CV. MITRA KOMPOS LEBAK <br>
                    </span>
                    <span><i>Jalan Raya Sajiar - Muncang Kp. Kalawijo RT/RW 002/005 Ds Sukamarga Kec. Sajira Lebak –
                            Banten </i></span>
                </td>
            </tr>
        </table>
        <hr class="garis1" />
        @php
            $all_dates = [];
            foreach ($absensi as $item) {
                $waktu_absensi = $item->created_at->format('H:i:s');
                $status = $item->created_at->format('H:i:s') > '08:00:00' ? 'Terlambat' : 'Hadir';
                $all_dates[$item->created_at->format('Y-m-d')][$item->karyawan_id] = [
                    'status' => $status,
                    'n_lengkap' => $item->karyawan->n_lengkap,
                ];
            }
            foreach ($cuti as $item) {
                $period = \Carbon\CarbonPeriod::create($item->tgl_mulai, $item->tgl_selesai);
                foreach ($period as $date) {
                    $all_dates[$date->format('Y-m-d')][$item->karyawan_id] = [
                        'status' => 'Cuti',
                        'n_lengkap' => $item->karyawan->n_lengkap,
                    ];
                }
            }
            for ($i = 1; $i <= \Carbon\Carbon::createFromDate(request('tahun'), request('bulan'))->daysInMonth; $i++) {
                $date = \Carbon\Carbon::create(request('tahun'), request('bulan'), $i)->format('Y-m-d');
                if (!isset($all_dates[$date])) {
                    $all_dates[$date] = [
                        'status' => 'Tidak Hadir',
                        'n_lengkap' => $item->karyawan->n_lengkap,
                    ];
                }
            }

        @endphp
        <table style="width: 100%; margin-top: 30px" border="1" class="tbz">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">
                        Nama Pegawai
                    </th>
                    @foreach (collect($all_dates)->sortKeys() as $date => $data)
                        @php
                            $daysInMonth = \Carbon\Carbon::parse($date)->daysInMonth;

                        @endphp
                    @endforeach
                    <th colspan="{{ $daysInMonth }}"> Tanggal</th>
                    </th>

                </tr>
                <tr>
                    @foreach (collect($all_dates)->sortKeys() as $date => $data)
                        <th>
                            {{ \Carbon\Carbon::parse($date)->format('d') }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $index => $employee)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $employee->n_lengkap }}</td>
                        @foreach (collect($all_dates)->sortKeys() as $date => $data)
                            <td>
                                @if (isset($data[$employee->id]))
                                    {{ $data[$employee->id]['status'] }}
                                @else
                                    -
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>

        </table>
    </section>

</body>

</html>
