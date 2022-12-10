<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends AdminController
{
    public function __construct()
    {
        $this->data['active'] = 'permission';
        $this->data['parent'] = 'auth';
        $this->data['edit'] = false;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!auth()->user()->can('permissions_view'), 403);
        
        $this->data['title'] = 'Permission List';
        $this->data['perm_edit'] = false;
        $this->data['perms'] = Permission::latest()->get();
        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current',$tables);
        $this->data['tables'] = $tables;
        return $this->admin_view('permission.list', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('permissions_add'), 403);
        
        $perms = $request->validate(['name' => 'required|max:250', 'table_name' => 'required']);

        Permission::create($perms);
        return back()->with('success', 'New Permission added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!auth()->user()->can('permissions_update'), 403);
        
        $this->data['title'] = 'Permissions';
        $this->data['perm_edit'] = Permission::findOrFail($id);
        $this->data['perms'] = Permission::where('id', '>', 1)->latest()->get();
        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current',$tables);
        $this->data['tables'] = $tables;
        $this->data['edit'] = true;
        return $this->admin_view('permission.list', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_if(!auth()->user()->can('permissions_update'), 403);
        
        $request->validate(['name' => 'required|max:250']);

        $perm = Permission::findOrFail($id);

        $perm->name = $request->name;
        $perm->save();

        return redirect(route('admin.permission.index'))->with('success', 'Permission successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        abort_if(!auth()->user()->can('permissions_delete'), 403);
        
        $temp = $permission;
        Permission::destroy($permission->id);
        return back()->with('success', 'Permission "'.$temp->name.'" successfully deleted!');
    }
}
