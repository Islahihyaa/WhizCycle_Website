@extends('admin.layout.admin-layout')

@section('title', 'WhizCycle | Kelola Kendaran')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Kelola Kendaraan</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Kendaraan</h5>
                        <hr>
                        <div class="text-start my-5">
                            <a href ="add-vehicles" name="add-vehicle" class="btn-custom"><i class="bi bi-plus-circle"></i><span class="m-2">Tambah Kendaraan</span></a>
                        </div>

                        <div class="col">
                            <table class="table datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Kendaraan</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data_vehicle as $data)
                                    <tr>
                                        <td scope="row">{{ $data -> vehicle_id }}</td>
                                        <td scope="row">{{ $data -> name_vehicle}}</td>
                                        <td scope="row">{{ $data -> category_vehicle}}</td>
                                        <td scope="row">{{ $data -> description_vehicle }}</td>
                                        <td scope="row">
                                            <div class="d-flex align-items-center">
                                                @if ($data->status_vehicle == 'Sudah Baik')
                                                    <p class="fw-bolder text-todo m-0">Sudah Baik</p> 
                                                @elseif ($data->status_vehicle == 'Butuh Perbaikan')
                                                    <p class="fw-bolder text-inprogress m-0">Butuh Perbaikan</p>
                                                @elseif ($data->status_vehicle == 'Sedang Dalam Perbaikan')
                                                    <p class="fw-bolder text-closed m-0">Sedang Dalam Perbaikan</p>
                                                @elseif ($data->status_vehicle == 'Tidak Dapat Digunakan')
                                                    <p class="fw-bolder text-closed m-0">Tidak Dapat Digunakan</p>
                                                @endif
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div class="filter">
                                                <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots m-3"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                                    <li class="dropdown-header text-start">
                                                        <h6>Ubah Status</h6>
                                                    </li>
                                                    <form method="POST" action="{{ route('status-vehicle.update', ['vehicle_id' => $data->vehicle_id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="dropdown-item" name="status_vehicle" value="Sudah Baik">Sudah Baik</button>
                                                        <button type="submit" class="dropdown-item" name="status_vehicle" value="Butuh Perbaikan">Butuh Perbaikan</button>
                                                        <button type="submit" class="dropdown-item" name="status_vehicle" value="Sedang Dalam Perbaikan">Sedang Dalam Perbaikan</button>
                                                        <button type="submit" class="dropdown-item" name="status_vehicle" value="Tidak Dapat Digunakan">Tidak Dapat Digunakan</button>
                                                    </form>
                                                </ul>
                                                <a href="{{ route('data-vehicle.delete', ['vehicle_id' => $data->vehicle_id]) }}">
                                                    <i class="bi bi-trash3-fill icon-background delete-icon"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                @if (Session::has('successDeleteVehicle'))
                                    <div class="alert alert-danger alert-lg"> {{ Session::get('successDeleteVehicle') }}</div>
                                @elseif (Session::has('failDeleteVehicle'))
                                    <div class="alert alert-danger alert-lg"> {{ Session::get('failDeleteVehicle') }}</div>
                                @elseif (session('updateStatusVehicle'))
                                        <div class="alert alert-primary alert-lg"> {{ Session::get('updateStatusVehicle') }}</div>
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
