@extends('frontend/layouts.template')

@section('content')

        <table class="table table-striped">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Gambar</th>
                    <th class="text-center" scope="col">Perempuan Subur</th>
                    <th class="text-center" scope="col">Wanita subur</th>
                    <th class="text-center" scope="col">Kb Perempuan</th>
                    <th class="text-center" scope="col">Kb Wanita</th>
                    <th class="text-center" scope="col">Kk Tbg</th>
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
                    <td>{{ $post1->gambar }}</td>
                    <td class="text-center">{{ $post1->J_Psubur }}</td>
                    <td class="text-center">{{ $post1->J_Wsubur }}</td>
                    <td class="text-center">{{ $post1->Kb_p }}</td>
                    <td class="text-center">{{ $post1->Kb_w }}</td>
                    <td class="text-center">{{ $post1->Kk_tbg }}</td>
                    <td>{{ $post1->status }}</td>
                    <td>{{ $post1->tanggal }}</td>
                    <td>
                       
                      
                    </td>
                  </tr>
                  @empty
                  <div class="alert alert-danger mt-4">
                      Tidak ada data perencanaan sehat
                  </div> 
                  @endforelse
                  
                </tbody>
              </table>
@endsection