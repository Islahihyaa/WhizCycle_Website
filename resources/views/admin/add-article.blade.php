@extends('admin.layout.admin-layout')

@section('title', 'Admin WhizCycle')

@section('manage-article', 'active')

@section('content')

    <main id="main" class="main">
        <!-- Page Content  -->
        <div class="pagetitle">
            <h1>Kelola Artikel</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Tambah Artikel</h5>
                        <hr>

                        <!-- Add Article Form Elements -->
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputTitle" class="col-sm-2 col-form-label">Judul Artikel</label>
                                <div class="col-sm-10">
                                    <input name="title" class="form-control" type="text" required></input>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputContent" class="col-sm-2 col-form-label">Content</label>
                                <div class="col-sm-10">
                                    <textarea name="content" class="form-control" type="text" rows="18" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputImage" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input name="image_article" class="form-control" type="file" accept="image/png, image/jpeg" required></input>
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