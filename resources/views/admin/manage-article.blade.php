@extends('admin.layout.admin-layout')

@section('title', 'WhizCycle | Kelola Kendaran')

@section('manage-article', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Kelola Artikel</h1>
    </div><!-- End Page Title -->

    <section class="section">
        @if(Session::has('success-to-delete-article'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success-to-delete-article')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
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
                                    <img src="{{ asset('storage/' . $data->image_article) }}" class="card-img-top my-4" alt="Article Image" width="100" height="200" style="object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $data->title }}</h5>
                                            <p class="card-text">{{ Str::limit($data->content, 100) }}</p>
                                            <a href="{{url('article/'.$data->article_id.'/detail')}}" class="btn-custom">Read More</a>
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
