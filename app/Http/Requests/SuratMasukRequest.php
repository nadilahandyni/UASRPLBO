<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratMasukRequest extends FormRequest
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
            'kode_surat_id' => ['required'],
            'user_id' => ['required'],
            'no_surat' => ['required', 'string', 'max:255'],
            'tgl_sm' => ['required'],
            'asal_surat' => ['required', 'string', 'max:255'],
            'tujuan_sm' => ['required'],
            'perihal' => ['required', 'string', 'max:255'],
        ];
    }
}
