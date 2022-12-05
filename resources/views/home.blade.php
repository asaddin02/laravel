@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Pesan Kopi</div>

                <div class="card-body">
                   <form action="{{ route('home.store') }}" method="post">
                    @csrf
                    <label class="col-form-label">Nama</label>
                    <input type="text" class="form-control" name="nama"
                        required>
                    <label class="col-form-label">Pesanan</label>
                    <input type="text" class="form-control" name="pesanan"
                        required>
                    <input type="submit" value="Submit" class=" btn btn-sm border border-success btn-rounded border-2">
                   </form>

                </div>
            </div>
        </div>
        @isset($data)
        <div class="col-md-6">

            <table class="table table-bordered">
                <tr class="bg-dark text-white">
                    <td colspan="2">Order</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $data['nama'] }}</td>
                </tr>
                <tr>
                    <th>Jumlah Pesanan</th>
                    <td>{{ $data['jumlah'] }}</td>
                </tr>
                <tr>
                    <th>Total Pesanan</th>
                    <td>{{ $data['total'] }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $data['status'] }}</td>
                </tr>
                <tr>
                    <th>Diskon</th>
                    <td>{{ $data['diskon'] }}</td>
                </tr>
                <tr>
                    <th>Total Pembayaran</th>
                    <td>{{ $data['tbayar'] }}</td>
                </tr>
            </table>
        </div>
        @endisset
    </div>
</div>
@endsection
