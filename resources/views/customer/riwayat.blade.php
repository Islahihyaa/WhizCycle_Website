
@extends('customer.layout.layout')

@section('title', 'WhizCycle | Pesanan')

@section('riwayat', 'active')

@section('content')

<main id="main" class="main">
        <!-- Page Content  -->
        <div class="pagetitle">
            <h1>Riwayat</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Riwayat Penjemputan</h5>
                        <hr>

                        @if(Session::has('status'))
                            <div class="alert alert-success"> {{ Session::get('status') }}</div>
                        @endif

                        <div class="col">
                            <table class="table datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal Pengambilan</th>
                                    <th>Kategori</th>
                                    <th>Berat</th>
                                    <th>Catatan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_order as $data)
                                    <tr>
                                        <td scope="row">{{ $data -> pickup_date }} / {{ $data -> pickup_time }}</td>
                                        <td scope="row">{{ $data -> category_trash }}</td>
                                        <td scope="row">{{ $data -> amount }} Kg</td>
                                        <td scope="row">{{ $data -> notes }}</td>
                                        <td scope="row">{{ $data -> status }}</td>
                                        <td scope="row">
                                            <div>
                                                <a href="detail-riwayat" >
                                                    <button class="btn-custom">Detail</button>
                                                </a>
                                                <a href="{{ url('riwayat-delete/' . $data->schedule_id) }}">
                                                    <i class="bi bi-trash3-fill icon-background delete-icon"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                @if (Session::has('deleteRiwayat'))
                                    <div class="alert alert-danger alert-lg"> {{ Session::get('deleteRiwayat') }}</div>
                                @endif

                                @if(session('updateStatus'))
                                    <div class="alert alert-primary alert-lg"> {{ Session::get('updateStatus') }}</div>
                                @endif
                            </table>
                        </div>
                        
                        
                        
                    </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection
