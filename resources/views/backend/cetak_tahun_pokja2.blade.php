<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Pertahun</title>
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

    <h3>Laporan Pendidikan Dan Keterampilan</h3>
    <table align="center">
				<tr>
                    <td align="center"><b>NO</b></td>
                    <td align="center"><b>Kecamatan</b></td>
                    <td align="center"><b>Warga Buta</b></td>
                    <td align="center"><b>Kel Belajar A</b></td>
                    <td align="center"><b>Warga Belajar A</b></td>
                    <td align="center"><b>Kel Belajar B</b></td>
                    <td align="center"><b>Warga Belajar B</b></td>
                    <td align="center"><b>Kel Belajar C</b></td>
                    <td align="center"><b>Warga Belajar C</b></td>
                    <td align="center"><b>Kel Belajar KF</b></td>
                    <td align="center"><b>Warga Belajar KF</b></td>
                    <td align="center"><b>Paud</b></td>
                    <td align="center"><b>Taman Bacaan</b></td>
                    <td align="center"><b>Jumlah Klp</b></td>
                    <td align="center"><b>JumLah Ibu Peserta</b></td>
                    <td align="center"><b>JumLah Ape</b></td>
                    <td align="center"><b>JumLah Kel Simulasi</b></td>
                    <td align="center"><b>KF</b></td>
                    <td align="center"><b>Paud Tutor</b></td>
                    <td align="center"><b>BKB</b></td>
                    <td align="center"><b>Koperasi</b></td>
                    <td align="center"><b>Ketrampilan</b></td>
                    <td align="center"><b>LP3PKK</b></td>
                    <td align="center"><b>TP3PKK</b></td>
                    <td align="center"><b>Damas PKK</b></td>
               
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($pendidikan as $item)
                <tr>
                    <th align="center">{{ $no++ }}</th>
                    <td align="center">{{ $item->nama_kec}}</td>
                    <td align="center">{{ $item->warga_buta}}</td>
                    <td align="center">{{ $item->kel_belajarA}}</td>
                    <td align="center">{{ $item->warga_belajarA}}</td>
                    <td align="center">{{ $item->kel_belajarB}}</td>
                    <td align="center">{{ $item->warga_belajarB}}</td>
                    <td align="center">{{ $item->kel_belajarC}}</td>
                    <td align="center">{{ $item->warga_belajarC}}</td>
                    <td align="center">{{ $item->kel_belajarKF}}</td>
                    <td align="center">{{ $item->warga_belajarKF}}</td>
                    <td align="center">{{ $item->paud}}</td>
                    <td align="center">{{ $item->taman_bacaan}}</td>
                    <td align="center">{{ $item->jumlah_klp}}</td>
                    <td align="center">{{ $item->jumlah_ibu_peserta}}</td>
                    <td align="center">{{ $item->jumlah_ape}}</td>
                    <td align="center">{{ $item->jumlah_kel_simulasi}}</td>
                    <td align="center">{{ $item->KF}}</td>
                    <td align="center">{{ $item->paud_tutor}}</td>
                    <td align="center">{{ $item->BKB}}</td>
                    <td align="center">{{ $item->koperasi}}</td>
                    <td align="center">{{ $item->ketrampilan}}</td>
                    <td align="center">{{ $item->LP3PKK}}</td>
                    <td align="center">{{ $item->TP3PKK}}</td>
                    <td align="center">{{ $item->damas_pkk}}</td>
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
                    <td align="center">{{ $total18 }}</td>
                    <td align="center">{{ $total19 }}</td>
                    <td align="center">{{ $total20 }}</td>
                    <td align="center">{{ $total21 }}</td>
                    <td align="center">{{ $total22 }}</td>
                    <td align="center">{{ $total23 }}</td>
                </tr>
    </table>

    <h3>Laporan Pengembangan Kehidupan Berkoperasi</h3>
    <table align="center">
				<tr>
                    <td align="center"><b>NO</b></td>
                    <td  align="center"><b>Kecamatan</b></td>
                    <td  align="center"><b>Jumlah Kel Pemula</b></td>
                    <td  align="center"><b>Jumlah Peserta Pemula</b></td>
                    <td  align="center"><b>Jumlah Kel Madya</b></td>
                    <td  align="center"><b>Jumlah Peserta Madya</b></td>
                    <td  align="center"><b>Jumlah Kel Utama</b></td>
                    <td  align="center"><b>Jumlah Peserta Utama</b></td>
                    <td  align="center"><b>Jumlah Kel Mandiri</b></td>
                    <td  align="center"><b>Jumlah Peserta Mandiri</b></td>
                    <td  align="center"><b>Jumlah Kel Hukum</b></td>
                    <td  align="center"><b>Jumlah Peserta Hukum</b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($pengembangan as $item)
                <tr>
                    <th align="center">{{ $no++ }}</th>
                    <td  align="center">{{ $item->nama_kec}}</td>
                    <td  align="center">{{ $item->jumlah_kelompok_pemula}}</td>
                    <td  align="center">{{ $item->jumlah_peserta_pemula}}</td>
                    <td  align="center">{{ $item->jumlah_kelompok_madya}}</td>
                    <td  align="center">{{ $item->jumlah_peserta_madya}}</td>
                    <td  align="center">{{ $item->jumlah_kelompok_utama}}</td>
                    <td  align="center">{{ $item->jumlah_peserta_utama}}</td>
                    <td  align="center">{{ $item->jumlah_kelompok_mandiri}}</td>
                    <td  align="center">{{ $item->jumlah_peserta_mandiri}}</td>
                    <td  align="center">{{ $item->jumlah_kelompok_hukum}}</td>
                    <td  align="center">{{ $item->jumlah_peserta_hukum}}</td>
                </tr>
                @endforeach
                <tr>
                    <td  colspan="2" align="center">Total</td>
                    <td align="center">{{ $total24 }}</td>
                    <td align="center">{{ $total25 }}</td>
                    <td align="center">{{ $total26 }}</td>
                    <td align="center">{{ $total27 }}</td>
                    <td align="center">{{ $total28 }}</td>
                    <td align="center">{{ $total29 }}</td>
                    <td align="center">{{ $total30 }}</td>
                    <td align="center">{{ $total31 }}</td>
                    <td align="center">{{ $total32 }}</td>
                    <td align="center">{{ $total33 }}</td>
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
