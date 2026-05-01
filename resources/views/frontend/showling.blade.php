@extends('frontend/layouts.template')

@section('content')

<table class="table table-striped">
<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Gambar</th>
        <th class="text-center" scope="col">Jamban</th>
        <th class="text-center" scope="col">Spal</th>
        <th class="text-center" scope="col">Tps</th>
        <th class="text-center" scope="col">Mck</th>
        <th class="text-center" scope="col">Pdam</th>
        <th class="text-center" scope="col">Sumur</th>
        <th class="text-center" scope="col">Dll</th>
        <th scope="col">Status</th>
        <th scope="col">tanggal</th>
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
        <td class="text-center">{{ $post1->jamban }}</td>
        <td class="text-center">{{ $post1->spal }}</td>
        <td class="text-center">{{ $post1->tps }}</td>
        <td class="text-center">{{ $post1->mck }}</td>
        <td class="text-center">{{ $post1->pdam }}</td>
        <td class="text-center">{{ $post1->sumur }}</td>
        <td class="text-center">{{ $post1->dll }}</td>
        <td>{{ $post1->status }}</td>
        <td>{{ $post1->tanggal }}</td>
      </tr>
      @empty
      <div class="alert alert-danger mt-4">
          Tidak ada data kelestarian lingkugan hidup
      </div> 
      @endforelse
      
    </tbody>
  </table>
@endsection