@extends('layouts.sidebar')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3>Disposisi</h3>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <span style="cursor: pointer; padding: 10px; font-size: 15px;" class="badge bg-success" data-bs-toggle="modal" data-bs-target="#inlineForm">Tambah</span>
                    <div class="modal fade text-left" id="inlineForm" tabindex="-1"
                         role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Tambah Disposisi Surat </h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('disposisisuratstore') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input class="form-control" name="surat_masuk_id" value="{{ $idsm }}" type="number" placeholder="ID" readonly>
                                        </div>
                                        <div class="form-group">
                                            <input type="date" name="tgl_selesai" class="form-control" id="tanggal" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="instruksi" rows="3" placeholder="Instruksi selanjutnya" required></textarea>
                                        </div>
                                        {{-- DITERUSKAN KEPADA --}}
                                        <label >Diteruskan kepada</label>
                                        @if (auth()->user()->jabatan != 'Admin Bidang Pengawasan Ketenagakerjaan' && auth()->user()->jabatan != 'Admin Bidang Penempatan dan Pelatihan' && auth()->user()->jabatan != 'Admin Bidang Hubungan industrial' && auth()->user()->jabatan != 'Admin Bidang Transmigrasi')
                                            <div class="form-check">
                                                <div class="form-group custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                           class="form-check-input form-check-primary"
                                                           name="ditujukan[]" id="customColorCheck1" value="Bidang Pengawasan Ketenagakerjaan">
                                                    <label class="form-check-label" for="customColorCheck1">Bidang Pengawasan Ketenagakerjaan</label>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <div class="form-group custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                           class="form-check-input form-check-primary"
                                                           name="ditujukan[]" id="customColorCheck2" value="Bidang Transmigrasi">
                                                    <label class="form-check-label" for="customColorCheck2">Bidang Transmigrasi</label>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <div class="form-group custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                           class="form-check-input form-check-primary"
                                                           name="ditujukan[]" id="customColorCheck3" value="Bidang Hubungan industrial">
                                                    <label class="form-check-label"
                                                           for="customColorCheck3">Bidang Hubungan industrial</label>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <div class="form-group custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                           class="form-check-input form-check-primary"
                                                           name="ditujukan[]" id="customColorCheck4" value="Bidang Penempatan dan Pelatihan">
                                                    <label class="form-check-label"
                                                           for="customColorCheck4">Bidang Penempatan dan Pelatihan</label>
                                                </div>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <input class="form-control" name="ditujukan[]" type="text" placeholder="Diteruskan kepada" required>
                                            </div>
                                        @endif
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
                    <table class="table table-striped" id="table1">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Penyelesaian</th>
                            <th>Instruksi Selanjutnya</th>
                            <th>Diteruskan Kepada</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($item as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d-m-Y', strtotime($i->tgl_selesai)) }}</td>
                                <td>{{ $i->instruksi }}</td>
                                <td>{{ implode(', ',$i->ditujukan) }}</td>
                                <td>
                                    {{-- icon edit --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal" data-bs-target="#FormEditDisposisi{{ $i->id }}" style="cursor: pointer;" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                    <div class="modal fade text-left" id="FormEditDisposisi{{ $i->id }}" tabindex="-1"
                                         role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel33">Edit Disposisi </h4>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                {{-- MODAL EDIT SURAT MASUK --}}
                                                <form action="{{ route('disposisisuratupdate', ['idds' => $i->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input class="form-control" name="surat_masuk_id" value="{{ $i->surat_masuk_id }}" type="number" placeholder="ID" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="date" name="tgl_selesai" value="{{ $i->tgl_selesai }}" class="form-control" id="tgl_selesai" placeholder="Tanggal Surat" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <input id="instruksi" name="instruksi" value="{{ $i->instruksi }}" type="text" placeholder="instruksi" class="form-control" required>
                                                        </div>
                                                        {{-- DITERUSKAN KEPADA --}}
                                                        <label >Diteruskan kepada</label>
                                                        @if (auth()->user()->jabatan != 'Admin Bidang Pengawasan Ketenagakerjaan' && auth()->user()->jabatan != 'Admin Bidang Penempatan dan Pelatihan' && auth()->user()->jabatan != 'Admin Bidang Hubungan industrial' && auth()->user()->jabatan != 'Admin Bidang Transmigrasi')
                                                            <div class="form-check">
                                                                <div class="form-group custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                           class="form-check-input form-check-primary"
                                                                           name="ditujukan[]" id="customColorCheck5" value="Bidang Pengawasan Ketenagakerjaan">
                                                                    <label class="form-check-label"
                                                                           for="customColorCheck5">Bidang Pengawasan Ketenagakerjaan</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-check">
                                                                <div class="form-group custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                           class="form-check-input form-check-primary"
                                                                           name="ditujukan[]" id="customColorCheck6" value="Bidang Transmigrasi">
                                                                    <label class="form-check-label"
                                                                           for="customColorCheck6">Bidang Transmigrasi</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-check">
                                                                <div class="form-group custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                           class="form-check-input form-check-primary"
                                                                           name="ditujukan[]" id="customColorCheck7" value="Bidang Hubungan industrial">
                                                                    <label class="form-check-label"
                                                                           for="customColorCheck7">Bidang Hubungan industrial</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-check">
                                                                <div class="form-group custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                           class="form-check-input form-check-primary"
                                                                           name="ditujukan[]" id="customColorCheck8" value="Bidang Penempatan dan Pelatihan">
                                                                    <label class="form-check-label"
                                                                           for="customColorCheck8">Bidang Penempatan dan Pelatihan</label>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="form-group">
                                                                <input class="form-control" name="ditujukan[]" value="{{ implode('',$i->ditujukan) }}" type="text" placeholder="Diteruskan kepada" required>
                                                            </div>
                                                        @endif
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
                                    <!-- MODAL Hapus Disposisi Surat -->
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
                                                        Apakah Anda yakin ingin menghapus disposisi ini?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button  type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Batal</span>
                                                    </button>
                                                    <form action="{{ route('disposisisuratdestroy', ['idds' => $i->id]) }}" method="POST">
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
