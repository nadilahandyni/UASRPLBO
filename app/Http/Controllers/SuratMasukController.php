<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratMasukRequest;
use App\Models\KodeSurat;
use App\Models\SuratMasuk;
use RealRashid\SweetAlert\Facades\Alert;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->jabatan == 'Kepala Dinas' || auth()->user()->jabatan == 'Admin Sekretariat') {
            $data = SuratMasuk::all();
        } else if (auth()->user()->jabatan == 'Kepala Bidang Pengawasan Ketenagakerjaan' || auth()->user()->jabatan == 'Admin Bidang Pengawasan Ketenagakerjaan') {
            $data = SuratMasuk::where('tujuan_sm', 'LIKE', '%Bidang Pengawasan Ketenagakerjaan%')->get();
        } else if (auth()->user()->jabatan == 'Kepala Bidang Transmigrasi' || auth()->user()->jabatan == 'Admin Bidang Transmigrasi') {
            $data = SuratMasuk::where('tujuan_sm', 'LIKE', '%Bidang Transmigrasi%')->get();
        } else if (auth()->user()->jabatan == 'Kepala Bidang Hubungan industrial' || auth()->user()->jabatan == 'Admin Bidang Hubungan industrial') {
            $data = SuratMasuk::where('tujuan_sm', 'LIKE', '%Bidang Hubungan industrial%')->get();
        } else if (auth()->user()->jabatan == 'Kepala Bidang Penempatan dan Pelatihan' || auth()->user()->jabatan == 'Admin Bidang Penempatan dan Pelatihan') {
            $data = SuratMasuk::where('tujuan_sm', 'LIKE', '%Bidang Penempatan dan Pelatihan%')->get();
        }

        $datakodesurat = KodeSurat::all();

        return view('suratmasuk.index', [
            'item' => $data,
            'itemkodesurat' => $datakodesurat,
        ])->with('active', 'suratmasuk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SuratMasukRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(SuratMasukRequest $request)
    {
        if (auth()->user()->jabatan != 'Kepala Dinas' && auth()->user()->jabatan != 'Admin Sekretariat') {
            return abort(403, 'Anda Tidak Punya Hak Akses');
        }

        $data = $request->all();
        $data['file_sm'] = $request->file('file_sm')->store('suratmasuk', 'public');
        SuratMasuk::create($data);

        Alert::success('Sukses', 'Data Berhasil Disimpan');

        return redirect()->route('suratmasuk');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SuratMasukRequest  $request
     * @param  int $suratMasuk
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(SuratMasukRequest $request, int $suratMasuk)
    {
        if (auth()->user()->jabatan != 'Kepala Dinas' && auth()->user()->jabatan != 'Admin Sekretariat') {
            return abort(403, 'Anda Tidak Punya Hak Akses');
        }

        $data = $request->all();

        if ($request->file('file_sm')) {
            $data['file_sm'] = $request->file('file_sm')->store('suratmasuk', 'public');
        } else {
            $file = SuratMasuk::where('id', $suratMasuk)->get();
            $data['file_sm'] = $file[0]->file_sm;
        }
        $cek = SuratMasuk::findOrFail($suratMasuk);
        $cek->update($data);

        Alert::success('Sukses', 'Data Berhasil Diubah');

        return redirect()->route('suratmasuk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $suratMasuk
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(int $suratMasuk)
    {
        if (auth()->user()->jabatan != 'Kepala Dinas' && auth()->user()->jabatan != 'Admin Sekretariat') {
            return abort(403, 'Anda Tidak Punya Hak Akses');
        }

        SuratMasuk::where('id', $suratMasuk)->delete();

        Alert::success('Sukses', 'Data Berhasil Dihapus');

        return redirect()->route('suratmasuk');
    }
}
