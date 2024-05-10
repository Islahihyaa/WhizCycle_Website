@extends('customer.layout.layout')

@section('title', 'WhizCycle')

@section('article', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Edukasi Lingkungan</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Artikel WhizCycle</h5>
                        <hr>
                        <div class="row">
                            @foreach($data_article as $data)
                                <div class="col-md-3 mb-4">
                                    <div class="card p-3">
                                        <img src="{{ asset('storage/' . $data->image_article) }}" class="card-img-top my-4" alt="Article Image" width="180" height="190">

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $data->title }}</h5>
                                            <p class="card-text">{{ Str::limit($data->content, 100) }}</p>
                                            <a href="{{url('/read-article/'. $data->article_id)}}" class="btn-custom">Read More</a>
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