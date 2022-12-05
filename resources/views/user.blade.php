{{-- tampilan halaman user --}}
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
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                    {{-- menampilkan data dari controller --}}
                    @foreach ($data as $d)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->password }}</td>
                            <td>{{ $d->role }}</td>
                            <td>
                                {{-- tombol modal edit --}}
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $d->id }}">Edit</a>

                                {{-- tombol modal hapus --}}
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapus{{ $d->id }}">Delete</a>

                            </td>
                        </tr>
                        {{-- modal untuk menghapus user --}}
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
                                        <b>{{ $d->name }}</b>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('user.destroy', $d->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-sm btn-danger text-white">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- modal untuk mengedit user --}}
                        <div class="modal fade" id="edit{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('user.update', $d->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3">
                                                <label class="col-form-label">Nama</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $d->name }}">
                                                <label class="col-form-label">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ $d->email }}">
                                                <label class="col-form-label">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    value="{{ $d->password }}">
                                                <label class="col-form-label">Role</label>
                                                <select name="role" id="" class="form-control">
                                                        <option value="{{ $d->role }}">Tidak ada role yang diubah</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="owner">Owner</option>
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

                {{-- modal untuk menambah user --}}
                <div class="modal fade" id="tambah" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="col-form-label">Nama</label>
                                        <input type="text" class="form-control" name="name"
                                            required>
                                        <label class="col-form-label">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            required>
                                        <label class="col-form-label">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            required>
                                        <label class="col-form-label">Role</label>
                                        <select name="role" id="" class="form-control" required>
                                                <option value="admin">Admin</option>
                                                <option value="owner">Owner</option>
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
