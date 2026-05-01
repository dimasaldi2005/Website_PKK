<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Perbulan</title>
    <style>
        table {
        width: 100%;
        border-collapse: collapse;
            }

        th, td {
        padding: 8px;
        border: 1px solid black;
        }
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 100px;
            height: auto;
            margin-right: 20px;
        }

        .header h1 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            margin: 0;
        }

        .address {
            margin-bottom: 20px;
        }

        .address p {
            margin: 0;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }

        .form-group .value {
            display: inline-block;
            width: calc(100% - 150px);
            vertical-align: top;
        }

        .separator {
            margin-bottom: 10px;
            border-top: 2px solid #000;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }

        .signature p {
            margin-bottom: 5px;
        }

        .container-grid {
            width: 100%;
            border: none;
            padding: 5px;
            margin-top: 50px;
            box-sizing: border-box;
            display: grid;
            grid-template-columns: 50% 50%;
            grid-template-rows: 50% 50%;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="logo-container">
            <img class="logo" src="{{ asset('frontend/assets/img/favicon.png') }}" alt="Logo PKK">
            <div>
                <h1>Pemberdayaan Kesejahteraan Keluarga</h1>
                <p>Kab. Nganjuk, Jawa Timur</p>
            </div>
            
        </div>
        <h2>Laporan Pertahun</h2>
        <h4>Tahun : {{ $tanggal }}</h4>
    </div>

    <div class="separator"></div>
    <div class ="signature">
        <p>Tanggal Cetak : {{ $formattedDate }}</p>
    </div>

    <h3>Laporan Bidang Umum</h3>
    <table align="center">
				<tr>
                    <td align="center"><b>NO</b></td>
                    <td align="center"><b>Kecamatan</b></td>
                    <td align="center"><b>Dusun Lingkungan</b></td>
                    <td align="center"><b>PKK RW</b></td>
                    <td align="center"><b>Desa Wisma</b></td>
                    <td align="center"><b>KRT</b></td>
                    <td align="center"><b>KK</b></td>
                    <td align="center"><b>Jiwa Laki</b></td>
                    <td align="center"><b>Jiwa Perempuan</b></td>
                    <td align="center"><b>Anggota Laki</b></td>
                    <td align="center"><b>Anggota Perempuan</b></td>
                    <td align="center"><b>Umum Laki</b></td>
                    <td align="center"><b>Umum Perempuan</b></td>
                    <td align="center"><b>Khusus Laki</b></td>
                    <td align="center"><b>Khusus Perempuan</b></td>
                    <td align="center"><b>Honorer Laki</b></td>
                    <td align="center"><b>Honorer Perempuan</b></td>
                    <td align="center"><b>Bantuan Laki</b></td>
                    <td align="center"><b>Bantuan Perempuan</b></td>
               
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($bidangumum as $item)
                <tr>
                    <th align="center">{{ $no++ }}</th>
                    <td align="center">{{ $item->nama_kec}}</td>
                    <td align="center">{{ $item->dusun_lingkungan}}</td>
                    <td align="center">{{ $item->PKK_RW}}</td>
                    <td align="center">{{ $item->desa_wisma}}</td>
                    <td align="center">{{ $item->KRT}}</td>
                    <td align="center">{{ $item->KK}}</td>
                    <td align="center">{{ $item->jiwa_laki}}</td>
                    <td align="center">{{ $item->jiwa_perempuan}}</td>
                    <td align="center">{{ $item->anggota_laki}}</td>
                    <td align="center">{{ $item->anggota_perempuan}}</td>
                    <td align="center">{{ $item->umum_laki}}</td>
                    <td align="center">{{ $item->umum_perempuan}}</td>
                    <td align="center">{{ $item->khusus_laki}}</td>
                    <td align="center">{{ $item->khusus_perempuan}}</td>
                    <td align="center">{{ $item->honorer_laki}}</td>
                    <td align="center">{{ $item->honorer_perempuan}}</td>
                    <td align="center">{{ $item->bantuan_laki}}</td>
                    <td align="center">{{ $item->bantuan_perempuan}}</td>
                @endforeach
                <tr>
                    <td  colspan="2" align="center">Total</td>
                    <td align="center">{{ $total1 }}</td>
                    <td align="center">{{ $total2 }}</td>
                    <td align="center">{{ $total3 }}</td>
                    <td align="center">{{ $total4 }}</td>
                    <td align="center">{{ $total5 }}</td>
                    <td align="center">{{ $total6 }}</td>
                    <td align="center">{{ $total7 }}</td>
                    <td align="center">{{ $total8 }}</td>
                    <td align="center">{{ $total9 }}</td>
                    <td align="center">{{ $total10 }}</td>
                    <td align="center">{{ $total11 }}</td>
                    <td align="center">{{ $total12 }}</td>
                    <td align="center">{{ $total13 }}</td>
                    <td align="center">{{ $total14 }}</td>
                    <td align="center">{{ $total15 }}</td>
                    <td align="center">{{ $total16 }}</td>
                    <td align="center">{{ $total17 }}</td>
                </tr>
    </table>

    <div class="container-grid">
        <div style="text-align: left;">
            <div style="text-align: center;">
                @forelse($wakil as $wakill)
                <a>Mengetahui</a></br>
                <a>TIM PENGGERAK PKK KABUPATEN NGANJUK</a></br>
                <a>{{ $wakill->jabatan }}</a></br><br><br><br>
                <a>{{ $wakill->nama_terang }}</a>
                @empty
                tidak ada data
                @endforelse
            </div>
        </div>

        <div style="text-align: right;">
            <div style="text-align: center;">
                @forelse($ketua as $ketuaa)
                <a>Nganjuk, <?php
                          echo date('d F Y');
                          ?></a></br>
                <a>{{ $ketuaa->pokja }}</a></br>
                <a>{{ $ketuaa->jabatan }}</a></br><br><br><br>
                <a>{{ $ketuaa->nama_terang }}</a>
                @empty
                tidak ada data
                @endforelse
            </div>
         </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</div>
</body>
</html>
