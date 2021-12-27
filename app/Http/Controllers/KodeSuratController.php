<?php

namespace App\Http\Controllers;

use App\Http\Requests\KodeSuratRequest;
use App\Models\KodeSurat;
use RealRashid\SweetAlert\Facades\Alert;

class KodeSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->jabatan != 'Kepala Dinas' && auth()->user()->jabatan != 'Admin Sekretariat') {
            return abort(403, 'Anda Tidak Punya Hak Akses');
        }

        $data = KodeSurat::all();

        return view('kodesurat.index', [
            'item' => $data,
        ])->with('active', 'kodesurat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\KodeSuratRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(KodeSuratRequest $request)
    {
        if (auth()->user()->jabatan != 'Kepala Dinas' && auth()->user()->jabatan != 'Admin Sekretariat') {
            return abort(403, 'Anda Tidak Punya Hak Akses');
        }

        $data = $request->all();
        KodeSurat::create($data);

        Alert::success('Sukses', 'Data Berhasil Disimpan');

        return redirect()->route('kodesurat');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\KodeSuratRequest  $request
     * @param  int  $kodeSurat
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(KodeSuratRequest $request, int $kodeSurat)
    {
        if (auth()->user()->jabatan != 'Kepala Dinas' && auth()->user()->jabatan != 'Admin Sekretariat') {
            return abort(403, 'Anda Tidak Punya Hak Akses');
        }

        $data = $request->all();
        $cek = KodeSurat::findOrFail($kodeSurat);
        $cek->update($data);

        Alert::success('Sukses', 'Data Berhasil Diubah');

        return redirect()->route('kodesurat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $kodeSurat
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(int $kodeSurat)
    {
        if (auth()->user()->jabatan != 'Kepala Dinas' && auth()->user()->jabatan != 'Admin Sekretariat') {
            return abort(403, 'Anda Tidak Punya Hak Akses');
        }

        KodeSurat::where('id', $kodeSurat)->delete();

        Alert::success('Sukses', 'Data Berhasil Dihapus');

        return redirect()->route('kodesurat');
    }
}
