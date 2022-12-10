<?php

namespace App\Http\Controllers;

use App\Models\SiteSettings;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public $data = [
        'active' => '',
        'parent' => ''
    ];
    

    public function admin_view($view='', $data=[])
    {
        $data = $this->data;
        $data['site_settings'] = SiteSettings::all();
        return view('admin.'.$view, $data);
    }
}
