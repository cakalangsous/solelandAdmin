<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public $data = [
        'active' => '',
        'parent' => ''
    ];
    

    public function dev_view($view='', $data=[])
    {
        $data = $this->data;
        return view('admin.developer.'.$view, $data);
    }
}
