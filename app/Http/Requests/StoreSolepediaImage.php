<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSolepediaImage extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            "solepedia_id" => "required|integer",
            "image" => "required|image|mimes:png,jpg,jpeg,svg"
        ];
    }
}
