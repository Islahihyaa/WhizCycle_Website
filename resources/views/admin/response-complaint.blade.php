@extends('admin.layout.admin-layout')

@section('title', 'WhizCycle | Pesanan')

@section('response-complaint', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Customer Service</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Response Complaint</h5>
                        <hr>

                        @if(Session::has('status'))
                            <div class="alert alert-success"> {{ Session::get('status') }}</div>
                        @endif

                        <div class="col">
                            <table class="table datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Complaint ID</th>
                                    <th>Nama User</th>
                                    <th>Subjek</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaintdata as $data)
                                    <tr>
                                        <td scope="row">{{ $data -> complaint_id }}</td>
                                        <td scope="row">{{ $data -> user -> name}}</td>
                                        <td scope="row">{{ $data -> subjek }}</td>
                                        <td scope="row">{{ $data -> description }}</td>
                                        <td scope="row" >{{ $data -> updated_at }}</td>
                                        <td scope="row">
                                            <div class="d-flex align-items-center">
                                                @if ($data->status == 'To Do')
                                                    <p class="fw-bolder text-todo m-0">To Do</p> 
                                                @elseif ($data->status == 'In Progress')
                                                    <p class="fw-bolder text-inprogress m-0">In Progress</p>
                                                @else
                                                    <p class="fw-bolder text-closed m-0">Closed</p>
                                                @endif
                                                <div class="filter">
                                                    <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots m-3"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                                        <li class="dropdown-header text-start">
                                                            <h6>Ubah Status</h6>
                                                        </li>
                                                        <form method="POST" action="{{ route('customer-service.update', ['complaint_id' => $data->complaint_id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="dropdown-item" name="status" value="To Do">To Do</button>
                                                            <button type="submit" class="dropdown-item" name="status" value="In Progress">In Progress</button>
                                                            <button type="submit" class="dropdown-item" name="status" value="Closed">Closed</button>
                                                        </form>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div>
                                                <a href="https://wa.me/{{ $data->phoneNumber }}" target="_blank" style="color: inherit; text-decoration: none;">
                                                    <i class="bi bi-whatsapp icon-background whatsapp-icon"></i>
                                                </a>
                                                <a href="mailto:{{ $data->email }}" target="_blank" style="color: inherit; text-decoration: none;">
                                                    <i class="bi bi-envelope-open icon-background email-icon"></i>
                                                </a>
                                                <a href="{{ url('complaint-delete/' . $data->complaint_id) }}">
                                                    <i class="bi bi-trash3-fill icon-background delete-icon"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                @if (Session::has('deleteComplaint'))
                                    <div class="alert alert-danger alert-lg"> {{ Session::get('deleteComplaint') }}</div>
                                @endif

                                @if(session('updateStatus'))
                                    <div class="alert alert-primary alert-lg"> {{ Session::get('updateStatus') }}</div>
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
