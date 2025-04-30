<?php

namespace MySoftITWebInstaller\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatabaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'database_connection' => 'required|string|in:mysql,pgsql,sqlsrv,sqlite',
            'database_hostname' => 'required|string',
            'database_port' => 'required|numeric',
            'database_name' => 'required|string',
            'database_username' => 'required|string',
            'database_password' => 'nullable|string',
        ];
    }
}