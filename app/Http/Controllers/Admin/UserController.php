<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\AdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends AdminController
{

    public function __construct()
    {
        $this->data['active'] = 'user';
        $this->data['parent'] = 'auth';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!auth()->user()->can('users_view'), 403);

        $this->data['title'] = 'Users List';
        $this->data['users'] = User::where('id', '>', 1)->latest()->get();
        return $this->admin_view('users.list', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('users_add'), 403);

        $this->data['title'] = 'User Add';
        $this->data['roles'] = Role::where('id', '>', 1)->latest()->get();
        return $this->admin_view('users.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        abort_if(!auth()->user()->can('users_add'), 403);

        $user = $request->validated();
         
        if ($request->file('photo')) {
            $user['photo'] = $request->file('photo')->store('admin');
        }

        $user['password'] = Hash::make($request->password);

        $admin = User::create($user);
        $role = Role::find($user['role']);

        $admin->assignRole($role->name);
        return redirect(route('admin.users.index'))->with('success', 'New user created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(!auth()->user()->can('users_update'), 403);

        abort_if($user->id==1, 404);

        $this->data['title'] = 'User Edit';
        $this->data['roles'] = Role::where('id', '>', 1)->latest()->get();
        $this->data['user'] = $user;
        $this->data['role_id'] = $user->roles->pluck('id');
        return $this->admin_view('users.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        abort_if(!auth()->user()->can('users_update'), 403);

        abort_if($user->id==1, 404);

        $rules = [
            'name' => 'required|max:250',
            'email' => 'required|email',
            'role' => 'required|numeric'
        ];

        if ($request->password != null) {
            $rules['password'] = 'required|min:8';
            $rules['password_confirmation'] = 'required|same:password|min:8';
        }

        if ($request->file('photo') != null) {
            $rules['photo'] = 'image|file|max:2048';
        }
        
        $validatedData = $request->validate($rules);
        
        if ($request->password != null) {
            $validatedData['password'] = Hash::make($request->password);
        }
        if ($request->file('photo') != null) {
            Storage::delete($user->photo);
            $validatedData['photo'] = $request->file('photo')->store('admin');
        }
        if (isset($validatedData['password_confirmation'])) {
            unset($validatedData['password_confirmation']);
        }

        $role = Role::find($validatedData['role']);


        unset($validatedData['role']);

        User::where('id', $user->id)->update($validatedData);

        $user->syncRoles([$role->name]);

        return redirect(route('admin.users.index'))->with('success', 'User "'.$user->name.'" data successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if(!auth()->user()->can('users_delete'), 403);
        abort_if($user->id==1, 404);

        Storage::delete($user->photo);
        User::destroy($user->id);

        return redirect(route('admin.users.index'))->with('success','User "'.$user->name.'" successfully deleted!');
    }

    public function banned(Request $request)
    {
        abort_if(!$request->ajax() || !auth()->user()->can('users_update'), 404);
        abort_if($request->user==1, 404, 'User not found');

        $request->validate([
            'user' => 'required',
            'status' => 'required'
        ]);

        $user = User::find($request->user);
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found']);
        }

        $user->banned = 0;
        if ($request->status == 'true') {
            $user->banned = 1;
        }

        $user->save();
        return response()->json(['status' => true, 'message' => 'User updated successfully']);
    }

    public function profile()
    {
        $this->data['parent'] = '';
        $this->data['active'] = '';
        $this->data['title'] = 'User Profile';
        $this->data['user'] = auth()->user();
        return $this->admin_view('users.profile', $this->data);
    }

    public function profile_update(Request $request)
    {
        $rules = [
            'name' => 'required|max:250'
        ];

        $request->except('email');

        $user = auth()->user();

        if ($request->password != null) {
            $rules['password'] = 'required|min:8';
            $rules['password_confirmation'] = 'required|same:password|min:8';
        }

        if ($request->file('photo') != null) {
            $rules['photo'] = 'image|file|max:2048';
        }
        
        $validatedData = $request->validate($rules);
        
        if ($request->password != null) {
            $validatedData['password'] = Hash::make($request->password);
        }
        if ($request->file('photo') != null) {
            Storage::delete($user->photo);
            $validatedData['photo'] = $request->file('photo')->store('admin');
        }
        if (isset($validatedData['password_confirmation'])) {
            unset($validatedData['password_confirmation']);
        }

        User::where('id', $user->id)->update($validatedData);

        return redirect(route('admin.users.profile'))->with('success', 'Profile updated!');
    }
}
