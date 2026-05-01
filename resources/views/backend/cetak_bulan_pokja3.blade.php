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
            width: 800px;
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
        <h2>Laporan Perbulan</h2>
        <h4>Bulan : {{ $tanggal }}</h4>
    </div>

    <div class="separator"></div>
    <div class ="signature">
        <p>Tanggal Cetak : {{ $formattedDate }}</p>
    </div>

    <h3>Laporan Program Pangan</h3>
    <table align="center">
				<tr>
                    <td align="center"><b>NO</b></td>
                    <td align="center"><b>Kecamatan</b></td>
                    <td align="center"><b>Beras</b></td>
                    <td align="center"><b>Non Beras</b></td>
                    <td align="center"><b>Peternakan</b></td>
                    <td align="center"><b>Perikanan</b></td>
                    <td align="center"><b>Warung Hidup</b></td>
                    <td align="center"><b>Lumbung Hidup</b></td>
                    <td align="center"><b>Toga</b></td>
                    <td align="center"><b>Tanaman Keras</b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($pangan as $item)
                <tr>
                    <th align="center">{{ $no++ }}</th>
                    <td align="center">{{ $item->nama_kec}}</td>
                    <td align="center">{{ $item->beras}}</td>
                    <td align="center">{{ $item->non_beras}}</td>
                    <td align="center">{{ $item->peternakan}}</td>
                    <td align="center">{{ $item->perikanan}}</td>
                    <td align="center">{{ $item->warung_hidup}}</td>
                    <td align="center">{{ $item->lumbung_hidup}}</td>
                    <td align="center">{{ $item->toga}}</td>
                    <td align="center">{{ $item->tanaman_keras}}</td>
                @endforeach
                <tr>
                    <td  colspan="2" align="center">Total</td>
                    <td align="center">{{ $total1 }}</td>
                    <td align="center">{{ $total2 }}</td>
                    <td align="center">{{ $total3 }}</td>
                    <td align="center">{{ $total31 }}</td>
                    <td align="center">{{ $total4 }}</td>
                    <td align="center">{{ $total5 }}</td>
                    <td align="center">{{ $total6 }}</td>
                    <td align="center">{{ $total7 }}</td>
                </tr>
    </table>

    <h3>Laporan Sandang</h3>
    <table align="center">
				<tr>
                    <td align="center"><b>NO</b></td>
                    <td  align="center"><b>Kecamatan</b></td>
                    <td  align="center"><b>Pangan</b></td>
                    <td  align="center"><b>Sandang</b></td>
                    <td  align="center"><b>Jasa</b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($sandang as $item)
                <tr>
                    <th align="center">{{ $no++ }}</th>
                    <td  align="center">{{ $item->nama_kec}}</td>
                    <td  align="center">{{ $item->pangan}}</td>
                    <td  align="center">{{ $item->sandang}}</td>
                    <td  align="center">{{ $item->jasa}}</td>
                </tr>
                @endforeach
                <tr>
                    <td  colspan="2" align="center">Total</td>
                    <td align="center">{{ $total24 }}</td>
                    <td align="center">{{ $total25 }}</td>
                    <td align="center">{{ $total26 }}</td>
                </tr>
    </table>

    <h3>Laporan Program Perumahan Dan Tata Laksana Rumah Tangga</h3>
    <table align="center">
				<tr>
                    <td align="center"><b>NO</b></td>
                    <td align="center"><b>Kecamatan</b></td>
                    <td align="center"><b>Layak Huni</b></td>
                    <td align="center"><b>Tidak Layak</b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($perumahan as $item)
                <tr>
                    <th align="center">{{ $no++ }}</th>
                    <td align="center">{{ $item->nama_kec}}</td>
                    <td align="center">{{ $item->layak_huni}}</td>
                    <td align="center">{{ $item->tidak_layak}}</td>
                @endforeach
                <tr>
                    <td  colspan="2" align="center">Total</td>
                    <td align="center">{{ $total8 }}</td>
                    <td align="center">{{ $total9 }}</td>
                </tr>
    </table>

    <h3>Laporan Kader Pokja 3</h3>
    <table align="center">
				<tr>
                    <td align="center"><b>NO</b></td>
                    <td align="center"><b>Kecamatan</b></td>
                    <td align="center"><b>Pangan</b></td>
                    <td align="center"><b>Sandang</b></td>
                    <td align="center"><b>Tata Laksana Rumah</b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($laporanpokja3 as $item)
                <tr>
                    <th align="center">{{ $no++ }}</th>
                    <td align="center">{{ $item->nama_kec}}</td>
                    <td align="center">{{ $item->pangan}}</td>
                    <td align="center">{{ $item->sandang}}</td>
                    <td align="center">{{ $item->tata_laksana_rumah}}</td>
                @endforeach
                <tr>
                    <td  colspan="2" align="center">Total</td>
                    <td align="center">{{ $total10 }}</td>
                    <td align="center">{{ $total11 }}</td>
                    <td align="center">{{ $total12 }}</td>
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
