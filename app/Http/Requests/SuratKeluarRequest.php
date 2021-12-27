<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratKeluarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required'],
            'tgl_sk' => ['required'],
            'perihal' => ['required', 'string', 'max:255'],
            'pegawai_id' => ['required'],
            'tujuan_surat' => ['required', 'string', 'max:255'],
        ];
    }
}
