@extends('layouts.sidebar')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="col-12 col-lg-5 col-md-5">
        <div class="card">
            <div class="card-body py-4 px-3">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl">
                        <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Face 1">
                    </div>
                    <div class="ms-3 name">
                        <h5 class="text-muted mb-0">{{ $nama }}</h5>
                        <h6 class="text-muted mb-0">{{ auth()->user()->nip }}</h6>
                        <h7 class="text-muted mb-0">{{ auth()->user()->jabatan }}</h7>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <h4>{{ date('M') }}</h4>
                <div class="row">
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon white">
                                            <img src="{{ asset('assets/images/samples/incoming-mail (2).png') }}" alt="logo" style="width:50px;height:50px;">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Surat Masuk</h6>
                                        <h6 class="font-extrabold mb-0">{{ $bulan_sm }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon white">
                                            <img src="{{ asset('assets/images/samples/outgoing.png') }}" alt="logo" style="width:50px;height:50px;">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Surat Keluar</h6>
                                        <h6 class="font-extrabold mb-0">{{ $bulan_sk }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <h4>{{ date('Y') }}</h4>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon white">
                                            <img src="{{ asset('assets/images/samples/incoming-mail (2).png') }}" alt="logo" style="width:50px;height:50px;">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Surat Masuk</h6>
                                        <h6 class="font-extrabold mb-0">{{ $tahun_sm }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon white">
                                            <img src="{{ asset('assets/images/samples/outgoing.png') }}" alt="logo" style="width:50px;height:50px;">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Surat Keluar</h6>
                                        <h6 class="font-extrabold mb-0">{{ $tahun_sk }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
