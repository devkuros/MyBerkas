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
            'nosurat' => ['required'],
            'perihal' => ['required', 'string'],
            'kategori_surat' => ['required'],
            'keterangan' => ['nullable'],
            'files' => ['required', 'mimes:pdf', 'max:2048'],
            'devisi' => ['required'],
            'tgl_surat' => ['required'],
        ];
    }
}
