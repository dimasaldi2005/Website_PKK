@extends('frontend/layouts.template')

@section('content')

        <table class="table table-striped">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Kategori</th>
                    <th class="text-center" scope="col">Posyandu</th>
                    <th class="text-center" scope="col">Posyandu Integrasi</th>
                    <th class="text-center" scope="col">Klp</th>
                    <th class="text-center" scope="col">Anggota</th>
                    <th class="text-center" scope="col">Kartu Gratis</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal</th>

                  </tr>
                </thead>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @forelse ($post as $post1)
                  <tr>
                    <th scope="row">{{ $no++ }}</th>
                    </td>
                    <td>{{ $post1->gambar_upload }}</td>
                    <td>{{ $post1->kategori_laporan }}</td>
                    <td class="text-center">{{ $post1->jumlah_posyandu }}</td>
                    <td class="text-center">{{ $post1->jumlah_posyandu_iterasi }}</td>
                    <td class="text-center">{{ $post1->jumlah_klp }}</td>
                    <td class="text-center">{{ $post1->jumlah_anggota }}</td>
                    <td class="text-center">{{ $post1->jumlah_kartu_gratis }}</td>
                    <td>{{ $post1->status }}</td>
                    <td>{{ $post1->tanggal }}</td>
                  </tr>
                  @empty
                  <div class="alert alert-danger mt-4">
                      Tidak ada data kesehatan
                  </div> 
                  @endforelse
                  
                </tbody>
              </table>
@endsection