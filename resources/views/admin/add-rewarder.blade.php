@extends('admin.layout.admin-layout')

@section('title', 'Admin WhizCycle')

@section('redeem-point', 'active')

@section('content')

    <main id="main" class="main">
        <!-- Page Content  -->
        <div class="pagetitle">
            <h1>Kelola Point</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Tambah Rewarder</h5>
                        <hr>

                        <!-- Add Rewarder Form Elements -->
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputName" class="col-sm-2 col-form-label">Nama Rewarder</label>
                                <div class="col-sm-10">
                                    <input name="name_rewarder" class="form-control" type="text" required></input>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputTitle" class="col-sm-2 col-form-label">Judul Reward</label>
                                <div class="col-sm-10">
                                    <input name="title_rewarder" class="form-control" type="text" required></input>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPoint" class="col-sm-2 col-form-label">Jumlah Point</label>
                                <div class="col-sm-10">
                                    <input name="point_rewarder" class="form-control" type="number" required></input>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDescription" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea name="description_rewarder" class="form-control" rows="10" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputLogo" class="col-sm-2 col-form-label">Logo</label>
                                <div class="col-sm-10">
                                    <input name="logo_rewarder" class="form-control" type="file" accept="image/png, image/jpeg" required></input>
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