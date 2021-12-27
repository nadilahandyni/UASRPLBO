<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratKeluarRequest;
use App\Models\KodeSurat;
use App\Models\Pegawai;
use App\Models\SuratKeluar;
use RealRashid\SweetAlert\Facades\Alert;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data = SuratKeluar::all();
        $datakodesurat = KodeSurat::all();
        $datapegawai = Pegawai::all();

        if ($data != '') {
            $status = 'Belum Diverifikasi';

            foreach ($data as $key => $value) {
                if ($value->no_surat != '') {
                    $status = 'Sudah Diverifikasi';
                }
            }
        }

        return view('suratkeluar.index', [
            'item' => $data,
            'itemkodesurat' => $datakodesurat,
            'itempegawai' => $datapegawai,
            'status' => $status,
        ])->with('active', 'suratkeluar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SuratKeluarRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(SuratKeluarRequest $request)
    {
        $data = $request->all();
        $data['file_sk'] = $request->file('file_sk')->store('suratkeluar', 'public');
        SuratKeluar::create($data);

        Alert::success('Sukses', 'Data Berhasil Disimpan');

        return redirect()->route('suratkeluar');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SuratKeluarRequest  $request
     * @param  int  $suratKeluar
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(SuratKeluarRequest $request, int $suratKeluar)
    {
        $data = $request->all();
        if ($request->file('file_sk')) {
            $data['file_sk'] = $request->file('file_sk')->store('suratkeluar', 'public');
        } else {
            $file = SuratKeluar::where('id', $suratKeluar)->get();
            $data['file_sk'] = $file[0]->file_sk;
        }
        $cek = SuratKeluar::findOrFail($suratKeluar);
        $cek->update($data);

        Alert::success('Sukses', 'Data Berhasil Diubah');

        return redirect()->route('suratkeluar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $suratKeluar
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(int $suratKeluar)
    {
        SuratKeluar::where('id', $suratKeluar)->delete();

        Alert::success('Sukses', 'Data Berhasil Dihapus');

        return redirect()->route('suratkeluar');
    }
}
