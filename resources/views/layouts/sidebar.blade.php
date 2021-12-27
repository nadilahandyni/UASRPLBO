<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Informasi Surat Masuk & Surat Keluar Dinas Tenaga Kerja Transmigrasi Provinsi Riau</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/all.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logodinaspemprovriau.png') }}" type="image/x-icon">
</head>

<body>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <img src="{{ asset('assets/images/logo/logodinas.png') }}"  alt="Logo" style="width:250px;height:50px;">
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    @if ($active == 'beranda')
                        <li class="sidebar-item active">
                            <a href="{{ route('beranda') }}" class='sidebar-link'>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        {{-- {{ route('suratmasuk') }} sesuaikan dgn name pada router web.php --}}
                        <li class="sidebar-item">
                            <a href="{{ route('suratmasuk') }}" class='sidebar-link'>
                                <span>Surat Masuk</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('suratkeluar') }}" class='sidebar-link'>
                                <span>Surat Keluar</span>
                            </a>
                        </li>
                        @if (auth()->user()->jabatan == 'Kepala Dinas' || auth()->user()->jabatan == 'Admin Sekretariat')
                            <li class="sidebar-item">
                                <a href="{{ route('kodesurat') }}" class='sidebar-link'>
                                    <span>Kode Surat</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item">
                            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="cursor: pointer;">
                                @csrf
                                <a class='sidebar-link bg-gradient-danger' onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <svg aria-hidden="true"  width="20" height="20"  focusable="false" data-prefix="fas" data-icon="sign-out-alt"
                                         class="svg-inline--fa fa-sign-out-alt fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path></svg>
                                    <span>Keluar</span>
                                </a>
                            </form>
                        </li>
                    @elseif ($active == 'suratmasuk')
                        <li class="sidebar-item">
                            <a href="{{ route('beranda') }}" class='sidebar-link'>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        {{-- {{ route('suratmasuk') }} sesuaikan dgn name pada router web.php --}}
                        <li class="sidebar-item  active">
                            <a href="{{ route('suratmasuk') }}" class='sidebar-link'>
                                <span>Surat Masuk</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('suratkeluar') }}" class='sidebar-link'>
                                <span>Surat Keluar</span>
                            </a>
                        </li>
                        @if (auth()->user()->jabatan == 'Kepala Dinas' || auth()->user()->jabatan == 'Admin Sekretariat')
                            <li class="sidebar-item">
                                <a href="{{ route('kodesurat') }}" class='sidebar-link'>
                                    <span>Kode Surat</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item">
                            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="cursor: pointer;">
                                @csrf
                                <a class='sidebar-link bg-gradient-danger' onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <svg aria-hidden="true"  width="20" height="20"  focusable="false" data-prefix="fas" data-icon="sign-out-alt"
                                         class="svg-inline--fa fa-sign-out-alt fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path></svg>
                                    <span>Keluar</span>
                                </a>
                            </form>
                        </li>
                    @elseif ($active == 'suratkeluar')
                        <li class="sidebar-item">
                            <a href="{{ route('beranda') }}" class='sidebar-link'>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        {{-- {{ route('suratmasuk') }} sesuaikan dgn name pada router web.php --}}
                        <li class="sidebar-item">
                            <a href="{{ route('suratmasuk') }}" class='sidebar-link'>
                                <span>Surat Masuk</span>
                            </a>
                        </li>
                        <li class="sidebar-item active">
                            <a href="{{ route('suratkeluar') }}" class='sidebar-link'>
                                <span>Surat Keluar</span>
                            </a>
                        </li>
                        @if (auth()->user()->jabatan == 'Kepala Dinas' || auth()->user()->jabatan == 'Admin Sekretariat')
                            <li class="sidebar-item">
                                <a href="{{ route('kodesurat') }}" class='sidebar-link'>
                                    <span>Kode Surat</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item">
                            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="cursor: pointer;">
                                @csrf
                                <a class='sidebar-link bg-gradient-danger' onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <svg aria-hidden="true"  width="20" height="20"  focusable="false" data-prefix="fas" data-icon="sign-out-alt"
                                         class="svg-inline--fa fa-sign-out-alt fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path></svg>
                                    <span>Keluar</span>
                                </a>
                            </form>
                        </li>
                    @elseif ($active == 'kodesurat')
                        <li class="sidebar-item">
                            <a href="{{ route('beranda') }}" class='sidebar-link'>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        {{-- {{ route('suratmasuk') }} sesuaikan dgn name pada router web.php --}}
                        <li class="sidebar-item">
                            <a href="{{ route('suratmasuk') }}" class='sidebar-link'>
                                <span>Surat Masuk</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('suratkeluar') }}" class='sidebar-link'>
                                <span>Surat Keluar</span>
                            </a>
                        </li>
                        @if (auth()->user()->jabatan == 'Kepala Dinas' || auth()->user()->jabatan == 'Admin Sekretariat')
                            <li class="sidebar-item active">
                                <a href="{{ route('kodesurat') }}" class='sidebar-link'>
                                    <span>Kode Surat</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item">
                            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="cursor: pointer;">
                                @csrf
                                <a class='sidebar-link bg-gradient-danger' onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <svg aria-hidden="true"  width="20" height="20"  focusable="false" data-prefix="fas" data-icon="sign-out-alt"
                                         class="svg-inline--fa fa-sign-out-alt fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path></svg>
                                    <span>Keluar</span>
                                </a>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main">
        @yield('content')
    </div>
</div>
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
