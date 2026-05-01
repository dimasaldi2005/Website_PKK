<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Kesehatan</title>
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
        <h2>Laporan Kesehatan</h2>
        <h4>Tanggal : {{ $tanggal  }}</h4>
    </div>

    <div class="separator"></div>
    <div class ="signature">
        <p>Tanggal Cetak : <?php
					echo '&nbsp;&nbsp;&nbsp;';
					echo date('d F Y');
					?></p>
    </div>

    <table align="center">
				<tr>
                    <td style='border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>NO</b></td>
                    <td style='border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Kategori</b></td>
					<td style='border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Posyandu</b></td>
					<td style='border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Posyandu Iterasi</b></td>
					<td style='border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>KLP</b></td>
					<td style='border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Anggota</b></td>
					<td style='border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>Kartu Gratis</b></td>
					<!-- <td style='border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>id_user</b></td> -->
				</tr>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach($kesehatan as $item)
                <tr>
                    <th scope="row" style='padding: 10px 15px 10px 15px;' align="center">{{ $no++ }}</th>
                    <td style='padding: 10px 45px 10px 45px;' align="center">{{ $item->kategori_laporan }}</td>
                    <td style='padding: 10px 45px 10px 45px;' align="center">{{ $item->jumlah_posyandu}}</td>
                    <td style='padding: 10px 45px 10px 45px;' align="center">{{ $item->jumlah_posyandu_iterasi}}</td>
                    <td style='padding: 10px 45px 10px 45px;' align="center">{{ $item->jumlah_klp }}</td>
                    <td style='padding: 10px 45px 10px 45px;' align="center">{{ $item->jumlah_anggota }}</td>
                    <td style='padding: 10px 45px 10px 45px;' align="center">{{ $item->jumlah_kartu_gratis }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2" style='padding: 10px 15px 10px 15px;' align="center">Total</td>
                    <td style='padding: 10px 45px 10px 45px;' align="center">{{ $total }}</td>
                    <td style='padding: 10px 45px 10px 45px;' align="center">{{ $total1 }}</td>
                    <td style='padding: 10px 45px 10px 45px;' align="center">{{ $total2 }}</td>
                    <td style='padding: 10px 45px 10px 45px;' align="center">{{ $total3 }}</td>
                    <td style='padding: 10px 45px 10px 45px;' align="center">{{ $total4 }}</td>
                </tr>
    </table>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</div>
</body>
</html>
