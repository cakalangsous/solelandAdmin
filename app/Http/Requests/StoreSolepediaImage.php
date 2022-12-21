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
            "content" => "required|file|mimes:png,jpg,jpeg,svg,mp4"
        ];
    }
}
