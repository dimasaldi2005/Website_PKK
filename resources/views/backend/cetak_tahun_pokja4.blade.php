{{-- resources/views/backend/cetak_tahun_pokja4.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cetak Laporan Pokja 4</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            font-size:12px;
            margin:25px;
            color:#000;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            border:1px solid #000;
            padding:6px;
            text-align:center;
            vertical-align:middle;
        }

        .no-border td{
            border:none !important;
            padding:0;
        }

        .header{
            width:100%;
            margin-bottom:20px;
        }

        .logo{
            width:75px;
        }

        .text-left{
            text-align:left;
        }

        .text-center{
            text-align:center;
        }

        .judul{
            font-size:18px;
            font-weight:bold;
            margin-bottom:5px;
        }

        .subjudul{
            font-size:13px;
            font-weight:bold;
        }

        .spasi{
            height:15px;
        }

        .ttd{
            margin-top:40px;
        }

        .ttd td{
            border:none;
            width:50%;
            text-align:center;
            vertical-align:top;
        }

        .nama{
            margin-top:70px;
            text-decoration:underline;
            font-weight:bold;
        }

    </style>
</head>

<body onload="window.print()">

{{-- HEADER --}}
<table class="no-border header">
    <tr>
        <td style="width:90px;">
            <img src="{{ asset('frontend/assets/img/favicon.png') }}" class="logo">
        </td>

        <td class="text-left">
            <b>Pemberdayaan Kesejahteraan Keluarga</b><br>
            Kab. Nganjuk, Jawa Timur
        </td>

        <td class="text-center">
            <div class="judul">LAPORAN POKJA IV</div>

            @if($jenis == 'bulan')
                <div class="subjudul">Bulan {{ $bulan_nama }} Tahun {{ $tahun }}</div>
            @elseif($jenis == 'tahun')
                <div class="subjudul">Tahun {{ $tahun }}</div>
            @elseif($jenis == 'bidang')
                <div class="subjudul">{{ strtoupper($bidang) }} - {{ $bulan_nama }} {{ $tahun }}</div>
            @endif
        </td>
    </tr>
</table>


{{-- TABEL DATA --}}
<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Kecamatan</th>
            <th>Desa</th>

            @if($bidang == 'semua' || $bidang == 'posyandu')
                <th>Posyandu</th>
            @endif

            @if($bidang == 'semua' || $bidang == 'gizi')
                <th>Gizi</th>
            @endif

            @if($bidang == 'semua' || $bidang == 'kesling')
                <th>Kesling</th>
            @endif

            @if($bidang == 'semua' || $bidang == 'narkoba')
                <th>Penyuluhan Narkoba</th>
            @endif

            @if($bidang == 'semua' || $bidang == 'phbs')
                <th>PHBS</th>
            @endif

            @if($bidang == 'semua' || $bidang == 'kb')
                <th>KB</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @php $no = 1; @endphp

        @foreach($data as $row)
        <tr>
            <td>{{ $no++ }}</td>
            <td class="text-left">{{ $row->nama_kec }}</td>
            <td class="text-left">{{ $row->nama_desa }}</td>

            @if($bidang == 'semua' || $bidang == 'posyandu')
                <td>{{ $row->posyandu }}</td>
            @endif

            @if($bidang == 'semua' || $bidang == 'gizi')
                <td>{{ $row->gizi }}</td>
            @endif

            @if($bidang == 'semua' || $bidang == 'kesling')
                <td>{{ $row->kesling }}</td>
            @endif

            @if($bidang == 'semua' || $bidang == 'narkoba')
                <td>{{ $row->penyuluhan_narkoba }}</td>
            @endif

            @if($bidang == 'semua' || $bidang == 'phbs')
                <td>{{ $row->PHBS }}</td>
            @endif

            @if($bidang == 'semua' || $bidang == 'kb')
                <td>{{ $row->KB }}</td>
            @endif
        </tr>
        @endforeach

        @if(count($data) == 0)
        <tr>
            <td colspan="20">Tidak ada data</td>
        </tr>
        @endif
    </tbody>
</table>


{{-- TTD --}}
<table class="ttd">
    <tr>
        <td>
            Mengetahui,<br>
            Ketua Pokja IV

            <div class="nama">
                @if(isset($ketua[0]))
                    {{ $ketua[0]->nama }}
                @else
                    __________________
                @endif
            </div>
        </td>   

        <td>
            Nganjuk, {{ date('d-m-Y') }}<br>
            Admin

            <div class="nama">
                @if(isset($wakil[0]))
                    {{ $wakil[0]->nama }}
                @else
                    __________________
                @endif
            </div>
        </td>
    </tr>
</table>

</body>
</html>