<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisposisiRequest;
use App\Models\Disposisi;
use RealRashid\SweetAlert\Facades\Alert;

class DisposisiSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(int $id)
    {
        $data = Disposisi::where('surat_masuk_id', $id)->get();
        return view('disposisisurat.index', [
            'item' => $data,
            'idsm' => $id,
        ])->with('active', 'suratmasuk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DisposisiRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(DisposisiRequest $request)
    {
        $data = $request->all();
        //Disposisi = model
        Disposisi::create($data);

        Alert::success('Sukses', 'Data Berhasil Disimpan');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DisposisiRequest  $request
     * @param  int  $disposisi
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(DisposisiRequest $request, int $disposisi)
    {
        $data = $request->all();
        $cek = Disposisi::findOrFail($disposisi);
        $cek->update($data);

        Alert::success('Sukses', 'Data Berhasil Diubah');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $disposisi
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(int $disposisi)
    {
        Disposisi::where('id', $disposisi)->delete();

        Alert::success('Sukses', 'Data Berhasil Dihapus');

        return back();
    }
}
