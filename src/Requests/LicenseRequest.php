<?php

namespace MySoftITWebInstaller\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LicenseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'license_key' => 'required|string|min:10',
        ];
    }
}