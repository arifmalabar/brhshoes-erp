@extends('layout.layout')

@section('status', 'active')
@section('judul', 'Data Bahan')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h4 class="card-title">Data Bahan</h4>
                <div class="card-tools">
                    <a href="{{ route('bahan.create') }}" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i> Tambah Bahan
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama</th>
                            <th>Kuantitas</th>
                            <th>Harga Modal</th>
                            <th>Jenis Bahan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kuantitas }}</td>
                                <td>{{ $item->harga_modal }}</td>
                                <td>{{ $item->jenis_bahan }}</td>
                                <td>
                                    <a href="{{ route('bahan.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('bahan.delete', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
