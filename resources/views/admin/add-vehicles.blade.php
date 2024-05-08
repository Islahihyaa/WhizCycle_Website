@extends('admin.layout.admin-layout')

@section('title', 'Admin WhizCycle')

@section('content')

    <main id="main" class="main">
        <!-- Page Content  -->
        <div class="pagetitle">
            <h1>Kelola Kendaraan</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Tambah Kendaraan</h5>
                        <hr>

                        <!-- Add Vehicle Form Elements -->
                        <form method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Nama Kendaraan</label>
                                <div class="col-sm-10">
                                    <input name="name_vehicle" class="form-control" required></input>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jenis Kendaraan</label>
                                <div class="col-sm-10">
                                    <select name="category_vehicle" class="form-select" required>
                                        <option>Kendaraan Roda 2</option>
                                        <option>Kendaraan Roda 3</option>
                                        <option>Kendaraan Roda 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea name="description_vehicle" class="form-control" row="3" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Status Kendaraan</label>
                                <div class="col-sm-10">
                                    <select name="status_vehicle" class="form-select" required>
                                        <option>Sudah Baik</option>
                                        <option>Butuh Perbaikan</option>
                                        <option>Sedang Dalam Perbaikan</option>
                                        <option>Tidak Dapat Digunakan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn-custom px-5"> SUBMIT</button>
                            </div>
                        </form>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                    @if(Session::has('status'))
                        <div class="alert alert-success"> {{ Session::get('status') }}</div>
                    @endif
                    @if(Session::has('notSetDataMessage'))
                        <div class="alert alert-success"> {{ Session::get('notSetDataMessage') }}</div>
                    @endif
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection