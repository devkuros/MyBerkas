<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateSuratRequest extends FormRequest
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
            'nama_surat' => ['required', 'string'],
            // 'file_template' => ['required', 'mimes:docx', 'max:2048'],
            'url_format' => ['required'],
            'ket_template' => ['nullable'],
            'file_format' => ['required']
        ];
    }
}
