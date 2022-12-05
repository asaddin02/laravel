{{-- tampilan halaman menu --}}
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
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                    {{-- menampilkan data dari controller --}}
                    @foreach ($data as $d)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama }}</td>
                            <td><img src="{{ asset('storage/' . $d->foto) }}" alt="" width="50px"></td>
                            <td>{{ $d->harga }}</td>
                            <td>{{ $d->kategori->Nama }}</td>
                            <td>{{ $d->keterangan }}</td>
                            <td>
                                {{-- tombol modal edit --}}
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $d->id }}">Edit</a>

                                {{-- tombol modal hapus --}}
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapus{{ $d->id }}">Delete</a>

                            </td>
                        </tr>
                        {{-- modal untuk menghapus menu --}}
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
                                        <b>{{ $d->nama }}</b>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('menu.destroy', $d->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-sm btn-danger text-white">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- modal untuk mengedit menu --}}
                        <div class="modal fade" id="edit{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('menu.update', $d->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3">
                                                <label class="col-form-label">Nama</label>
                                                <input type="text" class="form-control" name="nama"
                                                    value="{{ $d->nama }}">
                                                <label class="col-form-label">Harga</label>
                                                <input type="number" class="form-control" name="harga"
                                                    value="{{ $d->harga }}">
                                                <img src="{{ asset('storage/'. $d->foto) }}" width="100px" alt="">
                                                <label class="col-form-label">Foto</label>
                                                <input type="file" class="form-control" name="foto"
                                                    value="{{ $d->foto }}">
                                                <label class="col-form-label">Keterangan</label>
                                                <input type="text" class="form-control" name="keterangan"
                                                    value="{{ $d->keterangan }}">
                                                <label class="col-form-label">Kategori</label>
                                                <select name="kategori_id" id="" class="form-control">
                                                    <option value="{{ $d->kategori_id }}">Tidak ada kategori yang diubah
                                                    </option>
                                                    @foreach ($join as $j)
                                                        <option value="{{ $j->id }}">{{ $j->Nama }}</option>
                                                    @endforeach
                                                </select>
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

                {{-- modal untuk menambah menu --}}
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="col-form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" required>
                                        <label class="col-form-label">Harga</label>
                                        <input type="number" class="form-control" name="harga" required>
                                        <label class="col-form-label">Foto</label>
                                        <input type="file" class="form-control" name="foto" required>
                                        <label class="col-form-label">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" required>
                                        <label class="col-form-label">Kategori</label>
                                        <select name="kategori_id" id="" class="form-control" required>
                                            </option>
                                            @foreach ($join as $j)
                                                <option value="{{ $j->id }}">{{ $j->Nama }}</option>
                                            @endforeach
                                        </select>
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
