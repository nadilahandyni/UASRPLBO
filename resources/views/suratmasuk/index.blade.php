@extends('layouts.sidebar')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3>Surat Masuk</h3>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @if (auth()->user()->jabatan == 'Kepala Dinas' || auth()->user()->jabatan == 'Admin Sekretariat')
                        <span style="cursor: pointer; padding: 10px; font-size: 15px;" class="badge bg-success" data-bs-toggle="modal"
                              data-bs-target="#inlineForm">Tambah</span>
                        <!--MODAL TAMBAH SURAT MASUK-->
                        <div class="modal fade text-left" id="inlineForm" tabindex="-1"
                             role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Tambah Surat Masuk </h4>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('suratmasukstore') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <select name="kode_surat_id" class="form-control custom-select" required>
                                                    <option selected>Kode Surat</option>
                                                    @foreach ($itemkodesurat as $kd)
                                                        <option value="{{ $kd->id }}">{{ $kd->kode_surat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input id="nosurat" name="no_surat" type="text" placeholder="Nomor Surat" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="date" name="tgl_sm" class="form-control" id="tanggal" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="asal_surat" placeholder="Asal Surat" class="form-control" required>
                                            </div>
                                            {{-- TUJUAN SURAT --}}
                                            <label >Tujuan Surat</label>
                                            <div class="form-check">
                                                <div class="form-group custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                           class="form-check-input form-check-primary"
                                                           name="tujuan_sm[]" id="customColorCheck1" value="Bidang Pengawasan Ketenagakerjaan">
                                                    <label class="form-check-label" for="customColorCheck1">Bidang Pengawasan Ketenagakerjaan</label>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <div class="form-group custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                           class="form-check-input form-check-primary"
                                                           name="tujuan_sm[]" id="customColorCheck2" value="Bidang Transmigrasi">
                                                    <label class="form-check-label" for="customColorCheck2">Bidang Transmigrasi</label>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <div class="form-group custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                           class="form-check-input form-check-primary"
                                                           name="tujuan_sm[]" id="customColorCheck3" value="Bidang Hubungan industrial">
                                                    <label class="form-check-label" for="customColorCheck3">Bidang Hubungan industrial</label>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <div class="form-group custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                           class="form-check-input form-check-primary"
                                                           name="tujuan_sm[]" id="customColorCheck4" value="Bidang Penempatan dan Pelatihan">
                                                    <label class="form-check-label" for="customColorCheck4">Bidang Penempatan dan Pelatihan</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="perihal" placeholder="Perihal Surat" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputfilesuratmasuk">Masukkan File Surat Masuk</label>
                                                <input type="file" name="file_sm" class="form-control-file" id="inputfilesuratmasuk" required>
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
                            <th>No. Surat</th>
                            <th>Tanggal</th>
                            <th>Asal Surat</th>
                            <th>Tujuan Surat</th>
                            <th>Perihal</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($item as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- sm adalah nama function di modals suratmasuk --}}
                                @foreach ( $i->sm as $sm )
                                @endforeach
                                <td>{{ $sm->kode_surat }}</td>
                                <td>{{ $i->no_surat }}</td>
                                <td>{{ date('d-m-Y', strtotime($i->tgl_sm)) }}</td>
                                <td>{{ $i->asal_surat }}</td>
                                <td>{{ implode(', ',$i->tujuan_sm) }}</td>
                                <td>{{ $i->perihal }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $i->file_sm) }}" target="_blank" class="badge bg-primary">Lihat</a>
                                    <a class="badge bg-warning" href="{{ route('disposisisurat', ['idsm' => $i->id]) }}" role="button">Disposisi</a>
                                    @if (auth()->user()->jabatan == 'Kepala Dinas' || auth()->user()->jabatan == 'Admin Sekretariat')
                                        {{-- icon edit --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal" data-bs-target="#FormEditSuratMasuk{{ $i->id }}" style="cursor: pointer;" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                        <div class="modal fade text-left" id="FormEditSuratMasuk{{ $i->id }}" tabindex="-1"
                                             role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel33">Edit Surat Masuk </h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    {{-- MODAL EDIT SURAT MASUK --}}
                                                    <form action="{{ route('suratmasukupdate', ['idsm' => $i->id]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <select name="kode_surat_id" class="form-control custom-select" required>
                                                                    @foreach ($i->sm as $k)
                                                                    @endforeach
                                                                    <option value="{{ $i->kode_surat_id }}" selected>{{ $k->kode_surat }}</option>
                                                                    @foreach ($itemkodesurat as $kd)
                                                                        <option value="{{ $kd->id }}">{{ $kd->kode_surat }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input id="nosurat" name="no_surat" value="{{ $i->no_surat }}" type="text" placeholder="Nomor Surat" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="date" name="tgl_sm" value="{{ $i->tgl_sm }}" class="form-control" id="tanggal" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="asal_surat" value="{{ $i->asal_surat }}" placeholder="Asal Surat" class="form-control" required>
                                                            </div>
                                                            {{-- TUJUAN SURAT --}}
                                                            <label >Tujuan Surat</label>
                                                            <div class="form-check">
                                                                <div class="form-group custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                           class="form-check-input form-check-primary"
                                                                           name="tujuan_sm[]" id="customColorCheck5" value="Bidang Pengawasan Ketenagakerjaan">
                                                                    <label class="form-check-label"
                                                                           for="customColorCheck5">Bidang Pengawasan Ketenagakerjaan</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-check">
                                                                <div class="form-group custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                           class="form-check-input form-check-primary"
                                                                           name="tujuan_sm[]" id="customColorCheck6" value="Bidang Transmigrasi">
                                                                    <label class="form-check-label"
                                                                           for="customColorCheck6">Bidang Transmigrasi</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-check">
                                                                <div class="form-group custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                           class="form-check-input form-check-primary"
                                                                           name="tujuan_sm[]" id="customColorCheck7" value="Bidang Hubungan industrial">
                                                                    <label class="form-check-label"
                                                                           for="customColorCheck7">Bidang Hubungan industrial</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-check">
                                                                <div class="form-group custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                           class="form-check-input form-check-primary"
                                                                           name="tujuan_sm[]" id="customColorCheck8" value="Bidang Penempatan dan Pelatihan">
                                                                    <label class="form-check-label"
                                                                           for="customColorCheck8">Bidang Penempatan dan Pelatihan</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="perihal" value="{{ $i->perihal }}" placeholder="Perihal Surat" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputfilesuratmasuk">Masukkan File Surat Masuk</label>
                                                                <input type="file" name="file_sm" class="form-control-file" id="inputfilesuratmasuk">
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
                                        <!-- MODAL HAPUS SURAT MASUK -->
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
                                                            Apakah Anda yakin ingin menghapus surat masuk ini?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button  type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Batal</span>
                                                        </button>
                                                        <form action="{{ route('suratmasukdestroy', ['idsm' => $i->id]) }}" method="POST">
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
