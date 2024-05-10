@extends('customer.layout.layout')

@section('title', 'WhizCycle')

@section('redeems-point', 'active')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
    <h1>Tukar Point</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Terima Kasih atas Kontribusi untuk Lingkungan!</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <h5 class="card-total"><?php echo Auth::user()->total_points;?> Points</h5>
                            </div>
                        </div>
                        <div>
                            <p class="card-subtext">Point Tersedia</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Semua Rewards</h5>
                        @if(Session::has('success'))
                            <div class="alert alert-success"> {{ Session::get('success') }}</div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger"> {{ Session::get('error') }}</div>
                        @endif
                        @foreach ($data_point as $data)
                        <div class="card p-3" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <div class="d-flex align-items-center justify-content-around">
                                <img src="{{ asset('storage/'. $data->logo_rewarder) }}" alt="Logo Rewarder" width="100" height="60" style="border-radius: 8px; margin-right: 20px;">
                                <div>
                                    <h2 style="color: #333; font-size: 1.5rem; font-weight: bold; margin-bottom: 10px;">{{ $data->title_rewarder }}</h2>
                                    <h4 style="color: #444; font-size: 1.2rem; font-weight: normal; margin-bottom: 5px;">{{ $data->point_rewarder }} Points</h4>
                                    <p style="font-size: 1rem;">Point hadiah untuk tindakan ramah lingkungan!</p>
                                </div>
                                <div class="text-end ml-auto">
                                <form method="POST" action="{{ route('redeems-point.redeems', ['redeem_id' => $data->redeem_id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-custom" style="padding: 12px 20px; font-size: 1rem; border-radius: 10px;">Tukarkan Point</button>
                                </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection