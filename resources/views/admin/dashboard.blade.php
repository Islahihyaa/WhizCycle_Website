@extends('admin.layout.admin-layout')

@section('title', 'Admin WhizCycle')

@section('dashboard', 'active')

@section('content')

    <main id="main" class="main">
        <!-- Page Content  -->
        <div class="pagetitle">
            <h1>Beranda</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h5 class="card-title">Total User</h5>
                                        <h1 class="card-total">{{ $total_user }} User</h1>
                                    </div>
                                <div class="col-md-3 card-img-container">
                                    <img src="{{ asset('images/dashboard-icon.png') }}" alt="image" class="card-img">
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>       
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5 class="card-title">Total Setoran</h5>
                                    <h1 class="card-total"> {{ $recyle_total }} Setoran</h1>
                                </div>
                            <div class="col-md-3 card-img-container">
                                <img src="{{ asset('images/dashboard-icon2.png') }}" alt="image" class="card-img">
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Artikel</h5>
                    <div class="row">
                        @foreach($data_article as $data)
                            <div class="col-md-3 mb-4">
                                <div class="card p-3">
                                    <img src="{{ asset('storage/' . $data->image_article) }}" class="card-img-top my-4" alt="Article Image" width="180" height="190">
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
        </section>

    </main>

@endsection