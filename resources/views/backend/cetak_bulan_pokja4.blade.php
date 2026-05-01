<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan Perbulan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
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
            <h4>Bulan : {{ $created_at}}</h4>
        </div>

        <div class="separator"></div>
        <div class="signature">
            <p>Tanggal Cetak : {{ $formattedDate }}</p>
        </div>

        <h3>Laporan Kesehatan</h3>
        <table align="center">
            <tr>
                <td align="center"><b>NO</b></td>
                <td align="center"><b>Kecamatan</b></td>
                <td align="center"><b>Posyandu</b></td>
                <td align="center"><b>Posyandu <br>Iterasi</b></td>
                <td align="center"><b>KLP</b></td>
                <td align="center"><b>Anggota</b></td>
                <td align="center"><b>Kartu <br>Gratis</b></td>
            </tr>
            <tbody>

                @php
                    $no = 1;
                  @endphp
                @foreach($kesehatan as $item)
                    <tr>
                        <th scope="row" align="center">{{ $no++ }}</th>
                        <td align="center">{{ $item->nama_kec}}</td>
                        <td align="center">{{ $item->jumlah_posyandu}}</td>
                        <td align="center">{{ $item->jumlah_posyandu_iterasi}}</td>
                        <td align="center">{{ $item->jumlah_klp }}</td>
                        <td align="center">{{ $item->jumlah_anggota }}</td>
                        <td align="center">{{ $item->jumlah_kartu_gratis }}</td>
                        {{-- <td align="center">{{ $item->namaPengguna1 }}</td> --}}
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" align="center">Total</td>
                    <td align="center">{{ $total }}</td>
                    <td align="center">{{ $total1 }}</td>
                    <td align="center">{{ $total2 }}</td>
                    <td align="center">{{ $total3 }}</td>
                    <td align="center">{{ $total4 }}</td>
                    {{-- <td style='padding: 10px 45px 10px 45px;' align="center"></td> --}}
                </tr>
        </table>

        <h3>Laporan Kelestarian Lingkungan Hidup</h3>
        <table align="center">
            <tr>
                <td align="center"><b>NO</b></td>
                <td align="center"><b>Kecamatan</b></td>
                <td align="center"><b>Jamban</b></td>
                <td align="center"><b>Spal</b></td>
                <td align="center"><b>TPS</b></td>
                <td align="center"><b>MCK</b></td>
                <td align="center"><b>PDAM</b></td>
                <td align="center"><b>Sumur</b></td>
                <td align="center"><b>Dll</b></td>
                <!-- <td style='border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>id_user</b></td> -->
            </tr>
            <tbody>
                @php
                    $no = 1;
                  @endphp
                @foreach($kelestarian as $item)
                    <tr>
                        <th align="center">{{ $no++ }}</th>
                        <td align="center">{{ $item->nama_kec}}</td>
                        <td align="center">{{ $item->jamban }}</td>
                        <td align="center">{{ $item->spal}}</td>
                        <td align="center">{{ $item->tps}}</td>
                        <td align="center">{{ $item->mck }}</td>
                        <td align="center">{{ $item->pdam }}</td>
                        <td align="center">{{ $item->sumur }}</td>
                        <td align="center">{{ $item->dll }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" align="center">Total</td>
                    <td align="center">{{ $total5 }}</td>
                    <td align="center">{{ $total6 }}</td>
                    <td align="center">{{ $total7 }}</td>
                    <td align="center">{{ $total8 }}</td>
                    <td align="center">{{ $total9 }}</td>
                    <td align="center">{{ $total10 }}</td>
                    <td align="center">{{ $total11 }}</td>
                </tr>
        </table>

        <h3>Laporan Perencanaan Sehat</h3>
        <table align="center">
            <tr>
                <td align="center"><b>NO</b></td>
                <td align="center"><b>Kecamatan</b></td>
                <td align="center"><b>Perempuan Subur</b></td>
                <td align="center"><b>Wanita Subur</b></td>
                <td align="center"><b>KB Perempuan</b></td>
                <td align="center"><b>KB Wanita</b></td>
                <td align="center"><b>KK TBG</b></td>
                <!-- <td style='border: 1px #000; padding: 10px 25px 10px 25px;' align="center"><b>id_user</b></td> -->
            </tr>
            <tbody>
                @php
                    $no = 1;
                  @endphp
                @foreach($perencanaan as $item)
                    <tr>
                        <th align="center">{{ $no++ }}</th>
                        <td align="center">{{ $item->nama_kec}}</td>
                        <td align="center">{{ $item->J_Psubur }}</td>
                        <td align="center">{{ $item->J_Wsubur}}</td>
                        <td align="center">{{ $item->Kb_p}}</td>
                        <td align="center">{{ $item->Kb_w }}</td>
                        <td align="center">{{ $item->Kk_tbg }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" align="center">Total</td>
                    <td align="center">{{ $total12 }}</td>
                    <td align="center">{{ $total13 }}</td>
                    <td align="center">{{ $total14 }}</td>
                    <td align="center">{{ $total15 }}</td>
                    <td align="center">{{ $total16 }}</td>
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
                                        <a>Nganjuk,
                                            <?php
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
            window.onload = function () {
                window.print();
            };
        </script>
    </div>
</body>

</html>