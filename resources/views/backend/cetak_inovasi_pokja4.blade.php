<!DOCTYPE html>
<html>
<head>
    <title>Cetak Inovasi Pokja 4</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .container{
            width: 100%;
        }

        .header{
            text-align: center;
            margin-bottom: 20px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td{
            border: 1px solid black;
        }

        th, td{
            padding: 8px;
            text-align: center;
        }

        .ttd{
            margin-top: 60px;
            width: 100%;
        }

        .ttd td{
            border: none;
            width: 50%;
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">

<div class="container">

<div class="header">
    <h2>LAPORAN INOVASI POKJA IV</h2>
    <h4>{{ strtoupper($jenis_inovasi) }} - {{ $judul }}</h4>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kecamatan</th>
            <th>Desa</th>
            <th>Nama Inovasi</th>
            <th>Keterangan</th>
        </tr>
    </thead>

    <tbody>
        @php $no = 1; @endphp

        @foreach($data as $row)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $row->nama_kec }}</td>
            <td>{{ $row->nama_desa }}</td>
            <td>{{ $row->nama_inovasi }}</td>
            <td>{{ $row->keterangan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


<div class="ttd">
<table>
<tr>
<td>
Mengetahui,<br>
Ketua Pokja IV
<br><br><br><br>


@foreach($wakil as $item)
{{ $item->nama_terang }}
@endforeach
</td>

<td>
Nganjuk, {{ date('d-m-Y') }}<br>
Pokja IV
<br><br><br><br>

@foreach($ketua as $item)
{{ $item->nama_terang }}
@endforeach
</td>
</tr>
</table>
</div>

</div>

</body>
</html>