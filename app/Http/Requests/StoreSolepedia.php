<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSolepedia extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            "city_id" => "required|numeric",
            "title" => "required",
            "type" => "required",
        ];
    }
}
