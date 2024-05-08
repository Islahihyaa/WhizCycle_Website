@extends('admin.layout.admin-layout')

@section('title', 'WhizCycle | Kelola Kendaran')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Kelola Driver</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Driver</h5>
                        <hr>
                        <div class="text-start my-5">
                            <a href ="add-driver" name="add-driver" class="btn-custom"><i class="bi bi-plus-circle"></i><span class="m-2">Tambah Driver</span></a>
                        </div>

                        <div class="col">
                            <table class="table datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Driver</th>
                                    <th>Nama</th>
                                    <th>Nomor Telephone</th>
                                    <th>Nomor Lisensi</th>
                                    <th>Kendaraan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data_driver as $data)
                                    <tr>
                                        <td scope="row">{{ $data -> driver_id }}</td>
                                        <td scope="row">{{ $data -> name_driver}}</td>
                                        <td scope="row">{{ $data -> phoneNo_driver}}</td>
                                        <td scope="row">{{ $data -> license_number }}</td>
                                        <td scope="row">{{ $data -> vehicle -> name_vehicle }}</td>
                                        <td scope="row">
                                            <a href="{{ route('data-driver.delete', ['driver_id' => $data->driver_id]) }}">
                                                <i class="bi bi-trash3-fill icon-background delete-icon"></i>
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
