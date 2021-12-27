@extends('layouts.sidebar')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3>Surat Keluar</h3>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @if (auth()->user()->jabatan != 'Kepala Bidang Pengawasan Ketenagakerjaan' && auth()->user()->jabatan != 'Kepala Bidang Hubungan industrial' && auth()->user()->jabatan != 'Kepala Bidang Penempatan dan Pelatihan' && auth()->user()->jabatan != 'Kepala Bidang Transmigrasi')
                        <span style="cursor: pointer; padding: 10px; font-size: 15px;" class="badge bg-success" data-bs-toggle="modal"
                              data-bs-target="#inlineForm">Tambah</span>
                        <!--MODAL TAMBAH SURAT KELUAR-->
                        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Tambah Surat Keluar</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('suratkeluarstore') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                        <div class="modal-body">
                                            @if (auth()->user()->jabatan == 'Kepala Dinas' || auth()->user()->jabatan == 'Admin Sekretariat')
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <select name="kode_surat_id" class="form-control custom-select" required>
                                                            <option selected>Kode Surat</option>
                                                            @foreach ($itemkodesurat as $kd)
                                                                <option value="{{ $kd->id }}">{{ $kd->kode_surat }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="no_surat" placeholder="No. Surat" class="form-control" required>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <select name="pegawai_id" class="form-control custom-select" required>
                                                    <option selected>Pengolah Surat</option>
                                                    @foreach ($itempegawai as $pgw)
                                                        <option value="{{ $pgw->id }}">{{ $pgw->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="tujuan_surat" placeholder="Tujuan Surat" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="date" name="tgl_sk" class="form-control" id="tanggal" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="perihal" placeholder="Perihal Surat" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputfilesuratkeluar">Masukkan File Surat Keluar</label>
                                                <input type="file" name="file_sk" class="form-control-file" id="inputfilesuratkeluar" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Batal</span>
                                            </button>
                                            <button type="submit" class="btn btn-success ml-1">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Simpan</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    <table class="table table-striped" id="table1">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Pengolah Surat</th>
                            <th>No. Surat</th>
                            <th>Tujuan Surat</th>
                            <th>Tanggal</th>
                            <th>Perihal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($item as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- sk adalah nama function di modals suratmasuk --}}
                                @if ($i->kode_surat_id != '')
                                    @foreach ( $i->sk as $sk )
                                    @endforeach
                                    <td>{{ $sk->kode_surat }}</td>
                                @else
                                    <td>{{ $i->kode_surat }}</td>
                                @endif
                                @foreach ( $i->pgw as $pgw )
                                @endforeach
                                <td>{{ $pgw->nama }}</td>
                                <td>{{ $i->no_surat }}</td>
                                <td>{{ $i->tujuan_surat }}</td>
                                <td>{{ date('d-m-Y', strtotime($i->tgl_sk)) }}</td>
                                <td>{{ $i->perihal }}</td>
                                <td>
                                    @if ($i->no_surat != '')
                                        <span class="badge bg-success">Sudah Diverifikasi</span>
                                    @else
                                        <span class="badge bg-danger">Belum Diverifikasi</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $i->file_sk) }}" target="_blank" class="badge bg-primary">Lihat</a>
                                    @if ($i->no_surat != '' && auth()->user()->jabatan == 'Kepala Dinas' || auth()->user()->jabatan == 'Admin Sekretariat')
                                        {{-- icon edit --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal" data-bs-target="#FormEditSuratKeluar{{ $i->id }}" style="cursor: pointer;" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                        <div class="modal fade text-left" id="FormEditSuratKeluar{{ $i->id }}" tabindex="-1"
                                             role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel33">Edit Surat Keluar </h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    {{-- MODAL EDIT SURAT KELUAR --}}
                                                    <form action="{{ route('suratkeluarupdate', ['idsk' => $i->id]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                                        <div class="modal-body">
                                                            @if (auth()->user()->jabatan == 'Kepala Dinas' || auth()->user()->jabatan == 'Admin Sekretariat')
                                                                <div class="form-group">
                                                                    <select name="kode_surat_id" class="form-control custom-select" required>
                                                                        @if ($i->kode_surat_id != '')
                                                                            @foreach ($i->sk as $k)
                                                                            @endforeach
                                                                            <option value="{{ $i->kode_surat_id }}" selected>{{ $k->kode_surat }}</option>
                                                                        @else
                                                                            <option selected>Kode Surat</option>
                                                                        @endif
                                                                        @foreach ($itemkodesurat as $kd)
                                                                            <option value="{{ $kd->id }}">{{ $kd->kode_surat }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" name="no_surat" value="{{ $i->no_surat }}" class="form-control" id="no_surat" placeholder="Nomor Surat" required>
                                                                </div>
                                                            @endif
                                                            <div class="form-group">
                                                                <select name="pegawai_id" class="form-control custom-select" required>
                                                                    @foreach ($i->pgw as $pg)
                                                                    @endforeach
                                                                    <option value="{{ $i->pegawai_id }}" selected>{{ $pg->nama }}</option>
                                                                    @foreach ($itempegawai as $pgw)
                                                                        <option value="{{ $pgw->id }}">{{ $pgw->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="tujuan_surat" value="{{ $i->tujuan_surat }}" placeholder="Tujuan Surat" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="date" name="tgl_sk" value="{{ $i->tgl_sk }}" class="form-control" id="tgl_sk" placeholder="Tanggal Surat" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="perihal" value="{{ $i->perihal }}" class="form-control" id="perihal" placeholder="Perihal" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputfilesuratkeluar">Masukkan File Surat Keluar</label>
                                                                <input type="file" name="file_sk" class="form-control-file" id="inputfilesuratkeluar">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Batal</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-success ml-1">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Simpan</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- icon hapus --}}
                                        <svg  data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{ $i->id }}" style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                        <!-- MODAL HAPUS SURAT KELUAR -->
                                        <div class="modal fade" id="exampleModalCenter{{ $i->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            Apakah Anda yakin ingin menghapus surat keluar ini?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button  type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Batal</span>
                                                        </button>
                                                        <form action="{{ route('suratkeluardestroy', ['idsk' => $i->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger ml-1">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Hapus</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($i->no_surat == '' && auth()->user()->jabatan != 'Kepala Bidang Pengawasan Ketenagakerjaan' && auth()->user()->jabatan != 'Kepala Bidang Hubungan industrial' && auth()->user()->jabatan != 'Kepala Bidang Penempatan dan Pelatihan' && auth()->user()->jabatan != 'Kepala Bidang Transmigrasi')
                                        {{-- icon edit --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal" data-bs-target="#FormEditSuratKeluar{{ $i->id }}" style="cursor: pointer;" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                        <div class="modal fade text-left" id="FormEditSuratKeluar{{ $i->id }}" tabindex="-1"
                                             role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel33">Edit Surat Keluar </h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    {{-- MODAL EDIT SURAT KELUAR --}}
                                                    <form action="{{ route('suratkeluarupdate', ['idsk' => $i->id]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                                        <div class="modal-body">
                                                            @if (auth()->user()->jabatan == 'Kepala Dinas' || auth()->user()->jabatan == 'Admin Sekretariat')
                                                                <div class="form-group">
                                                                    <select name="kode_surat_id" class="form-control custom-select" required>
                                                                        @if ($i->kode_surat_id != '')
                                                                            @foreach ($i->sk as $k)
                                                                            @endforeach
                                                                            <option value="{{ $i->kode_surat_id }}" selected>{{ $k->kode_surat }}</option>
                                                                        @else
                                                                            <option selected>Kode Surat</option>
                                                                        @endif
                                                                        @foreach ($itemkodesurat as $kd)
                                                                            <option value="{{ $kd->id }}">{{ $kd->kode_surat }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" name="no_surat" value="{{ $i->no_surat }}" class="form-control" id="no_surat" placeholder="Nomor Surat" required>
                                                                </div>
                                                            @endif
                                                            <div class="form-group">
                                                                <select name="pegawai_id" class="form-control custom-select" required>
                                                                    @foreach ($i->pgw as $pg)
                                                                    @endforeach
                                                                    <option value="{{ $i->pegawai_id }}" selected>{{ $pg->nama }}</option>
                                                                    @foreach ($itempegawai as $pgw)
                                                                        <option value="{{ $pgw->id }}">{{ $pgw->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="tujuan_surat" value="{{ $i->tujuan_surat }}" placeholder="Tujuan Surat" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="date" name="tgl_sk" value="{{ $i->tgl_sk }}" class="form-control" id="tgl_sk" placeholder="Tanggal Surat" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="perihal" value="{{ $i->perihal }}" class="form-control" id="perihal" placeholder="Perihal" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputfilesuratkeluar">Masukkan File Surat Keluar</label>
                                                                <input type="file" name="file_sk" class="form-control-file" id="inputfilesuratkeluar">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Batal</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-success ml-1">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Simpan</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- icon hapus --}}
                                        <svg  data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{ $i->id }}" style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                        <!-- MODAL HAPUS SURAT KELUAR -->
                                        <div class="modal fade" id="exampleModalCenter{{ $i->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            Apakah Anda yakin ingin menghapus surat keluar ini?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button  type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Batal</span>
                                                        </button>
                                                        <form action="{{ route('suratkeluardestroy', ['idsk' => $i->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger ml-1">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Hapus</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
