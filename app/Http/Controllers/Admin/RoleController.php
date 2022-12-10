<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends AdminController
{
    public function __construct()
    {
        $this->data['active'] = 'roles';
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
        abort_if(!auth()->user()->can('roles_view'), 403);
        
        $this->data['title'] = 'Roles';
        $this->data['roles'] = Role::where('id', '>', 1)->get();
        return $this->admin_view('roles.list', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('roles_add'), 403);
        
        $role = $request->validate(['name' => 'required|max:250']);

        Role::create($role);
        return back()->with('success', 'New Role added successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!auth()->user()->can('roles_update'), 403);
        
        $this->data['title'] = 'Roles';
        $this->data['role_edit'] = Role::findOrFail($id);
        $this->data['roles'] = Role::where('id', '>', 1)->get();
        $this->data['edit'] = true;
        return $this->admin_view('roles.list', $this->data);
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
        abort_if(!auth()->user()->can('roles_update'), 403);
        
        $request->validate(['name' => 'required|max:250']);

        $role = Role::findOrFail($id);

        $role->name = $request->name;
        $role->save();

        return redirect(route('admin.roles.index'))->with('success', 'Role successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        abort_if(!auth()->user()->can('roles_delete'), 403);
        
        $temp = $role;
        Role::destroy($role->id);
        return back()->with('success', 'Role "'.$temp->name.'" successfully deleted!');
    }
}
