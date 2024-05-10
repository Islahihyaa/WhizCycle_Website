@extends('admin.layout.admin-layout')

@section('title', 'Admin WhizCycle')

@section('manage-driver', 'active')

@section('content')

    <main id="main" class="main">
        <!-- Page Content  -->
        <div class="pagetitle">
            <h1>Kelola Driver</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Tambah Driver</h5>
                        <hr>

                        <!-- Add Driver Form Elements -->
                        <form method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputName" class="col-sm-2 col-form-label">Nama Driver</label>
                                <div class="col-sm-10">
                                    <input name="name_driver" class="form-control" type="text" required></input>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo" class="col-sm-2 col-form-label">Nomor Telephone</label>
                                <div class="col-sm-10">
                                    <input name="phoneNo_driver" class="form-control" type="number" required></input>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Nomor Lisensi</label>
                                <div class="col-sm-10">
                                    <input name="license_number" class="form-control" type="text" required></input>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kendaraan</label>
                                <div class="col-sm-10">
                                    <select name="vehicle_id" class="form-select" required>
                                        @foreach($data_vehicle as $select_vehicle)
                                            <option value="{{ $select_vehicle->vehicle_id }}">{{ $select_vehicle -> name_vehicle }}</option>
                                        @endforeach
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