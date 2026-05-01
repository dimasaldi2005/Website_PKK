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
            margin-top: 50px; 
            padding: 5px;
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
        <h2>Laporan Perbulan</h2>
        <h4>Bulan : {{$created_at}}</h4>
    </div>

    <div class="separator"></div>
    <div class ="signature">
        <p>Tanggal Cetak : {{ $formattedDate }}</p>
    </div>

    <h3>Laporan Gotong Royong</h3>
    <table align="center">
				<tr>
                    <td align="center"><b>NO</b></td>
                    <td align="center"><b>Kecamatan</b></td>
                    <td align="center"><b>Kerja Bakti</b></td>
                    <td align="center"><b>Rukun Kematian</b></td>
                    <td align="center"><b>Keagamaan</b></td>
                    <td align="center"><b>Jimpitan</b></td>
                    <td align="center"><b>Arisan</b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($gotongroyong as $item)
                <tr>
                    <th align="center">{{ $no++ }}</th>
                    <td align="center">{{ $item->nama_kec}}</td>
                    <td align="center">{{ $item->kerja_bakti}}</td>
                    <td align="center">{{ $item->rukun_kematian}}</td>
                    <td align="center">{{ $item->keagamaan}}</td>
                    <td align="center">{{ $item->jimpitan}}</td>
                    <td align="center">{{ $item->arisan}}</td>
                </tr>
                @endforeach
                <tr>
                    <td  colspan="2" align="center">Total</td>
                    <td align="center">{{ $total5 }}</td>
                    <td align="center">{{ $total6 }}</td>
                    <td align="center">{{ $total7 }}</td>
                    <td align="center">{{ $total8 }}</td>
                    <td align="center">{{ $total9 }}</td>
                </tr>
    </table>

    <h3>Laporan Penghayatan Dan Pengamalan Pancasila</h3>
    <table align="center">
				<tr>
                    <td align="center"><b>NO</b></td>
                    <td  align="center"><b>Kecamatan</b></td>
                    <td  align="center"><b>Jumlah Kel Simulasi 1</b></td>
                    <td  align="center"><b>Jumlah Anggota 1</b></td>
                    <td  align="center"><b>Jumlah Kel Simulasi 2</b></td>
                    <td  align="center"><b>Jumlah Anggota 2</b></td>
                    <td  align="center"><b>Jumlah Kel Simulasi 3</b></td>
                    <td  align="center"><b>Jumlah Anggota 3</b></td>
                    <td  align="center"><b>Jumlah Kel Simulasi 4</b></td>
                    <td  align="center"><b>Jumlah Anggota 4</b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($penghayatan as $item)
                <tr>
                    <th align="center">{{ $no++ }}</th>
                    <td  align="center">{{ $item->nama_kec}}</td>
                    <td  align="center">{{ $item->jumlah_kel_simulasi1}}</td>
                    <td  align="center">{{ $item->jumlah_anggota1}}</td>
                    <td  align="center">{{ $item->jumlah_kel_simulasi2}}</td>
                    <td  align="center">{{ $item->jumlah_anggota2}}</td>
                    <td  align="center">{{ $item->jumlah_kel_simulasi3}}</td>
                    <td  align="center">{{ $item->jumlah_anggota3}}</td>
                    <td  align="center">{{ $item->jumlah_kel_simulasi4}}</td>
                    <td  align="center">{{ $item->jumlah_anggota4}}</td>
                </tr>
                @endforeach
                <tr>
                    <td  colspan="2" align="center">Total</td>
                    <td align="center">{{ $total12 }}</td>
                    <td align="center">{{ $total13 }}</td>
                    <td align="center">{{ $total14 }}</td>
                    <td align="center">{{ $total15 }}</td>
                    <td align="center">{{ $total16 }}</td>
                    <td align="center">{{ $total17 }}</td>
                    <td align="center">{{ $total18 }}</td>
                    <td align="center">{{ $total19 }}</td>
                </tr>
    </table>

    <h3>Laporan Kader Pokja 1</h3>
    <table align="center">
				<tr>
                    <td  align="center"><b>NO</b></td>
                    <td  align="center"><b>Kecamatan</b></td>
                    <td  align="center"><b>PKBN</b></td>
                    <td  align="center"><b>PKDRT</b></td>
                    <td  align="center"><b>Pola Asuh</b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($laporanpokja1 as $item)
                <tr>
                    <th scope="row"  align="center">{{ $no++ }}</th>
                    <td  align="center">{{ $item->nama_kec}}</td>
                    <td  align="center">{{ $item->PKBN}}</td>
                    <td  align="center">{{ $item->PKDRT}}</td>
                    <td  align="center">{{ $item->pola_asuh}}</td>
                @endforeach
                <tr>
                    <td  colspan="2" align="center">Total</td>
                    <td  align="center">{{ $total }}</td>
                    <td  align="center">{{ $total1 }}</td>
                    <td  align="center">{{ $total2 }}</td>
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
