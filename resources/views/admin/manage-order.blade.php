@extends('admin.layout.admin-layout')

@section('title', 'WhizCycle | Kelola Kendaran')

@section('manage-order', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Kelola Order</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Order Customer</h5>
                        <hr>
                        <div class="col">
                            <table class="table datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Nomor</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal Penjemputan</th>
                                    <th>Kategori Sampah</th>
                                    <th>Berat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data_order as $data)
                                    <tr>
                                        <td scope="row">{{ $loop -> iteration }}</td>
                                        <td scope="row">{{ $data -> user -> name }}</td>
                                        <td scope="row">{{ $data -> pickup_date }} / {{ $data -> pickup_time }}</td>
                                        <td scope="row">{{ $data -> category_trash }}</td>
                                        <td scope="row">{{ $data -> amount }} Kg</td>
                                        <td scope="row">{{ $data -> status }}</td>
                                        <td scope="row">
                                            <a href="{{ route('manage-order-detail', ['schedule_id' => $data->schedule_id]) }}">
                                            <button class="btn-custom">Detail</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                @if (Session::has('successDeleteDriver'))
                                    <div class="alert alert-danger alert-lg"> {{ Session::get('successDeleteDriver') }}</div>
                                @elseif (Session::has('failDeleteDriver'))
                                    <div class="alert alert-danger alert-lg"> {{ Session::get('failDeleteDriver') }}</div>
                                @endif
                            </table>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
