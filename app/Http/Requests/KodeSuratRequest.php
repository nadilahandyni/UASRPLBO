<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KodeSuratRequest extends FormRequest
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
            'kode_surat' => ['required', 'string', 'max:255'],
            'nama_kode' => ['required', 'string', 'max:255'],
        ];
    }
}
