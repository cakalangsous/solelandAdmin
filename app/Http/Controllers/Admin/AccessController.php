<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AccessController extends AdminController
{
    public function __construct()
    {
        $this->data['active'] = 'access';
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
        abort_if(!auth()->user()->can('access_view'), 403);

        $this->data['title'] = 'Access';
        $this->data['perms'] = Permission::latest()->get();
        $this->data['roles'] = Role::where('id', '>', 1)->latest()->get();
        return $this->admin_view('access.list', $this->data);
    }

    public function perms_by_role(Request $request)
    {
        abort_if(!$request->ajax() || !auth()->user()->can('access_view'), 403);
        
        $request->validate(['role' => 'required']);

        $role = Role::findOrFail($request->role);
        $role_perms = $role->permissions;
        $perms = Permission::all();

        foreach ($perms as $perm) {
            $group_name = '';
            $perm_tmp_arr = explode('_', $perm->name);

            if (isset($perm_tmp_arr[0]) AND !empty($perm_tmp_arr[0])) {
                $group_name =  strtolower($perm_tmp_arr[0]);
            }

            if ($perm->table_name!=NULL) {
                $group_name =  strtolower($perm->table_name);
            }

            $group_perms_groupping[$group_name][] = $perm;
        }

        return response()->json(['status' => true, 'message' => 'Get perms success!', 'perms' => $group_perms_groupping, 'role_perms' => $role_perms]);
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
        abort_if(!auth()->user()->can('access_update'), 403);
        
        $role = Role::findOrFail($id);

        $role->syncPermissions($request->perms);
        return redirect(route('admin.access.index'))->with('success', 'Permission updated to '.$role->name.'!');
    }
}
