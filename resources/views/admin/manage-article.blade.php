@extends('admin.layout.admin-layout')

@section('title', 'WhizCycle | Kelola Kendaran')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Kelola Artikel</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Artikel</h5>
                        <hr>
                        <div class="text-start my-5">
                            <a href ="add-article" name="add-article" class="btn-custom"><i class="bi bi-plus-circle"></i><span class="m-2">Tambah Artikel</span></a>
                        </div>

                        <div class="row">
                            @foreach($data_article as $data)
                                <div class="col-md-3 mb-4">
                                    <div class="card p-3">
                                        @if($data->image)
                                            <img src="{{ $data->image_article }}" class="card-img-top my-4" alt="Article Image">
                                        @else
                                            <!-- Tampilkan placeholder gambar jika tidak ada gambar -->
                                            <img src="{{ asset('assets/img/placeholder.png') }}" class="card-img-top my-4" alt="Placeholder Image">
                                        @endif 
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $data->title }}</h5>
                                            <p class="card-text">{{ Str::limit($data->content, 100) }} @if(strlen($data->content) > 100) <a href="#" class="read-more">... Baca Selengkapnya</a> @endif</p>
                                            <a href="#" class="btn btn-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
