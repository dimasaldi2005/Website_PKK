<!DOCTYPE html>
<html>
<head>
    <title>Cetak Galeri</title>
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
        <h2 style='font-size: 36px;' align="center">REKAPITULASI</h2>
        <h4 style='font-size: 28px;' align="center">JADWAL KEGIATAN TIM PENGGERAK PKK</br>
        KABUPATEN NGANJUK</br>
        TAHUN {{ $tanggal2 }}</br></h4>
    </div>

    <div class="separator"></div>
    <div class ="signature">
        <p>Tanggal Cetak : <?php
					echo '&nbsp;&nbsp;&nbsp;';
					echo date('d F Y');
					?></p></br>
    </div>

    <table align="center">
				<tr>
                    <td scope="row" colspan="3" style='font-size: 28px; background-color: #A9A9A9; border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Bulan Januari </b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($jan as $tampil)
                <tr>
                    <th style='font-size: 18px; border: 1px #000; padding: 10px 15px 10px 15px;' align="justify">{{ $no++ }}.</th>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ \Carbon\Carbon::parse($tampil->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ $tampil->deskripsi}}</td>
                </tr>
                @endforeach      
    </table>
                @if($jan->isEmpty())
                <p>Tidak ada data pada bulan ini.</p>
                @endif

    <table align="center">
				<tr>
                    <td scope="row" colspan="3" style='font-size: 28px; background-color: #A9A9A9; border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Bulan Februari </b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($feb as $tampil1)
                <tr>
                    <th style='font-size: 18px; border: 1px #000; padding: 10px 15px 10px 15px;' align="justify">{{ $no++ }}.</th>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ \Carbon\Carbon::parse($tampil1->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ $tampil1->deskripsi}}</td>
                </tr>
                @endforeach
    </table>
                @if($feb->isEmpty())
                <p>Tidak ada data pada bulan ini.</p>
                @endif

    <table align="center">
				<tr>
                    <td scope="row" colspan="3" style='font-size: 28px; background-color: #A9A9A9; border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Bulan Maret </b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($mar as $tampil2)
                <tr>
                    <th style='font-size: 18px; border: 1px #000; padding: 10px 15px 10px 15px;' align="justify">{{ $no++ }}.</th>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ \Carbon\Carbon::parse($tampil2->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ $tampil2->deskripsi}}</td>
                </tr>
                @endforeach
    </table>
                @if($mar->isEmpty())
                <p>Tidak ada data pada bulan ini.</p>
                @endif

    <table align="center">
				<tr>
                    <td scope="row" colspan="3" style='font-size: 28px; background-color: #A9A9A9; border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Bulan April </b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($apr as $tampil3)
                <tr>
                    <th style='font-size: 18px; border: 1px #000; padding: 10px 15px 10px 15px;' align="justify">{{ $no++ }}.</th>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ \Carbon\Carbon::parse($tampil3->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ $tampil3->deskripsi}}</td>
                </tr>
                @endforeach
    </table>
                @if($apr->isEmpty())
                <p>Tidak ada data pada bulan ini.</p>
                @endif

    <table align="center">
				<tr>
                    <td scope="row" colspan="3" style='font-size: 28px; background-color: #A9A9A9; border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Bulan Mei </b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($mei as $tampil4)
                <tr>
                    <th style='font-size: 18px; border: 1px #000; padding: 10px 15px 10px 15px;' align="justify">{{ $no++ }}.</th>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ \Carbon\Carbon::parse($tampil4->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ $tampil4->deskripsi}}</td>
                </tr>
                @endforeach
    </table>
                @if($mei->isEmpty())
                <p>Tidak ada data pada bulan ini.</p>
                @endif

    <table align="center">
				<tr>
                    <td scope="row" colspan="3" style='font-size: 28px; background-color: #A9A9A9; border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Bulan Juni </b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($jun as $tampil5)
                <tr>
                    <th style='font-size: 18px; border: 1px #000; padding: 10px 15px 10px 15px;' align="justify">{{ $no++ }}.</th>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ \Carbon\Carbon::parse($tampil5->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ $tampil5->deskripsi}}</td>
                </tr>
                @endforeach
    </table>
                @if($jun->isEmpty())
                <p>Tidak ada data pada bulan ini.</p>
                @endif

    <table align="center">
				<tr>
                    <td scope="row" colspan="3" style='font-size: 28px; background-color: #A9A9A9; border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Bulan Juli </b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($jul as $tampil6)
                <tr>
                    <th style='font-size: 18px; border: 1px #000; padding: 10px 15px 10px 15px;' align="justify">{{ $no++ }}.</th>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ \Carbon\Carbon::parse($tampil6->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ $tampil6->deskripsi}}</td>
                </tr>
                @endforeach
    </table>
                @if($jul->isEmpty())
                <p>Tidak ada data pada bulan ini.</p>
                @endif

    <table align="center">
				<tr>
                    <td scope="row" colspan="3" style='font-size: 28px; background-color: #A9A9A9; border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Bulan Agustus </b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($agu as $tampil7)
                <tr>
                    <th style='font-size: 18px; border: 1px #000; padding: 10px 15px 10px 15px;' align="justify">{{ $no++ }}.</th>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ \Carbon\Carbon::parse($tampil7->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ $tampil7->deskripsi}}</td>
                </tr>
                @endforeach
    </table>
                @if($agu->isEmpty())
                <p>Tidak ada data pada bulan ini.</p>
                @endif

    <table align="center">
				<tr>
                    <td scope="row" colspan="3" style='font-size: 28px; background-color: #A9A9A9; border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Bulan September </b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($sep as $tampil8)
                <tr>
                    <th style='font-size: 18px; border: 1px #000; padding: 10px 15px 10px 15px;' align="justify">{{ $no++ }}.</th>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ \Carbon\Carbon::parse($tampil8->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ $tampil8->deskripsi}}</td>
                </tr>
                @endforeach
    </table>
                @if($sep->isEmpty())
                <p>Tidak ada data pada bulan ini.</p>
                @endif

    <table align="center">
				<tr>
                    <td scope="row" colspan="3" style='font-size: 28px; background-color: #A9A9A9; border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Bulan Oktober </b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($okt as $tampil9)
                <tr>
                    <th style='font-size: 18px; border: 1px #000; padding: 10px 15px 10px 15px;' align="justify">{{ $no++ }}.</th>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ \Carbon\Carbon::parse($tampil9->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ $tampil9->deskripsi}}</td>
                </tr>
                @endforeach
    </table>
                @if($okt->isEmpty())
                <p>Tidak ada data pada bulan ini.</p>
                @endif

    <table align="center">
				<tr>
                    <td scope="row" colspan="3" style='font-size: 28px; background-color: #A9A9A9; border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Bulan November </b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($nov as $tampil10)
                <tr>
                    <th style='font-size: 18px; border: 1px #000; padding: 10px 15px 10px 15px;' align="justify">{{ $no++ }}.</th>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ \Carbon\Carbon::parse($tampil10->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ $tampil10->deskripsi}}</td>
                </tr>

                @endforeach
    </table>
                @if($nov->isEmpty())
                <p>Tidak ada data pada bulan ini.</p>
                @endif

    <table align="center">
				<tr>
                    <td scope="row" colspan="3" style='font-size: 28px; background-color: #A9A9A9; border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Bulan Desember </b></td>
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($des as $tampil11)
                <tr>
                    <th style='font-size: 18px; border: 1px #000; padding: 10px 15px 10px 15px;' align="justify">{{ $no++ }}.</th>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ \Carbon\Carbon::parse($tampil11->tanggal)->isoFormat('D MMMM Y') }}</td>
                    <td style='font-size: 18px; border: 1px #000; padding: 10px 45px 10px 45px;' align="justify">{{ $tampil11->deskripsi}}</td>
                </tr>
                @endforeach
    </table>
                @if($des->isEmpty())
                <p>Tidak ada data pada bulan ini.</p>
                @endif

                  <div class="container-grid">
        <div style="text-align: left;">
            <div style="text-align: center;">
                <p></p>
            </div>
        </div>

        <div style="text-align: right;">
            <div style="text-align: center;">
                @forelse($ketua as $ketuaa)
                <a>Nganjuk, <?php
                          echo date('d F Y');
                          ?></a><br>
                <a>TP PKK Kabupaten Nganjuk</a><br>
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
