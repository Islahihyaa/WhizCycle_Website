@extends('admin.layout.admin-layout')

@section('title', 'WhizCycle | Kelola Kendaran')

@section('redeem-point', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Kelola Point</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Kolaborator Rewarder</h5>
                        <hr>
                        <div class="text-start my-5">
                            <a href ="add-rewarder" name="add-rewarder" class="btn-custom"><i class="bi bi-plus-circle"></i><span class="m-2">Tambah Rewarder</span></a>
                        </div>

                        <div class="col">
                            <table class="table datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Rewarder</th>
                                    <th>Judul</th>
                                    <th>Jumlah Point yang Diberikan</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data_rewarder as $data)
                                <tr>
                                    <td scope="row">{{ $data -> name_rewarder }}</td>
                                    <td scope="row">{{ $data -> title_rewarder}}</td>
                                    <td scope="row">{{ $data -> point_rewarder }}</td>
                                    <td scope="row">{{ $data -> description_rewarder }}</td>
                                    <td scope="row">
                                        <a href="{{ route('delete-rewarder.delete', ['redeem_id' => $data->redeem_id]) }}">
                                            <i class="bi bi-trash3-fill icon-background delete-icon"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                                </tbody>
                                @if (Session::has('successDeleteRewarder'))
                                    <div class="alert alert-danger alert-lg"> {{ Session::get('successDeleteRewarder') }}</div>
                                @elseif (Session::has('failDeleteRewarder'))
                                    <div class="alert alert-danger alert-lg"> {{ Session::get('failDeleteRewarder') }}</div>
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
