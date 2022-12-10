<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Request;

class DashboardController extends AdminController
{
    public function __construct()
    {
        $this->data['active'] = 'dashboard';
    }

    public function index(Request $request)
    {
        $this->data['title'] = 'Dashboard';
        return $this->admin_view('dashboard', $this->data);
    }
}
