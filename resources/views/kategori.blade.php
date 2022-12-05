{{-- tampilan halaman kategori --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                {{-- tombol modal tambah --}}
                <a href="#" class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                    data-bs-target="#tambah">Tambah</a>
                <table class="table table-bordered">
                    <tr class="text-center bg-dark text-white">
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                    {{-- menampilkan data dari controller --}}
                    @foreach ($data as $d)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->Nama }}</td>
                            <td>
                                {{-- tombol modal edit --}}
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $d->id }}">Edit</a>

                                {{-- tombol modal hapus --}}
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapus{{ $d->id }}">Delete</a>

                            </td>
                        </tr>
                        {{-- modal untuk menghapus kategori --}}
                        <div class="modal fade" id="hapus{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <b>{{ $d->Nama }}</b>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('kategori.destroy', $d->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-sm btn-danger text-white">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- modal untuk mengedit kategori --}}
                        <div class="modal fade" id="edit{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('kategori.update', $d->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3">
                                                <label class="col-form-label">Kategori</label>
                                                <input type="text" class="form-control" name="Nama"
                                                    value="{{ $d->Nama }}">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" value="Edit" class="btn btn-sm btn-primary text-white">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </table>

                {{-- modal untuk menambah kategori --}}
                <div class="modal fade" id="tambah" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('kategori.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="col-form-label">Kategori</label>
                                        <input type="text" class="form-control" name="Nama"
                                            required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" value="Tambah" class="btn btn-sm btn-info text-white">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
