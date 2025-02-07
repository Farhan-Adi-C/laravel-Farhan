<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('users.user', compact('users', 'roles'));   
    }

    public function role(){
        $role = Role::with('permissions')->get();
        $permissionAll = Permission::all();
        return view('users.role', compact('role', 'permissionAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function role_post(Request $request){

        $request->validate([
            'role' => 'required|string',
            'permission' => 'required'
        ]);

        $role = new Role();
        $role->name = $request->role;
        $role->save();

        $role->permissions()->sync($request->permission);
        return redirect()->back()->with('success', 'berhasil menambahkan Role');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $roleUser = $user->roles->pluck('id')->toArray();
        return view('users.change-role', compact('user', 'roles', 'roleUser'));
    }
    
    public function edit_role_permission($id)
{
    $role = Role::findOrFail($id);
    $permissionAll = Permission::all(); 
    return view('users.edit-permission-role', compact('role', 'permissionAll'));
}

    /**
     * Update the specified resource in storage.
     */
 
     public function updateRoleUser(Request $request, string $id)
     {
         $request->validate([
             'role' => 'required', 
         ]);
     
         $user = User::find($id); 
         $roleId = $request->role;  
         $role = Role::find($roleId); 

    if (!$role) {
        return redirect()->back()->with('error', 'Role not found');
    }

    $user->syncRoles([$role->name]);  
     
         return redirect()->route('user')->with('success', 'Role updated successfully');
     }
     

    public function role_update(Request $request)
{
    $request->validate([
        'role_id' => 'required|exists:roles,id', 
        'role' => 'required|string',
        'permission' => 'required|array',  
    ]);

    $role = Role::findOrFail($request->role_id);

    $role->name = $request->role;
    $role->save();

    $role->permissions()->sync($request->permission);

    return redirect()->back()->with('success', 'Berhasil memperbarui Role');
}

public function update_role_permission(Request $request, $id)
{
    $request->validate([
        'role' => 'required|string|max:255',
        'permission' => 'required|array',
    ]);

    $role = Role::findOrFail($id);
    $role->name = $request->role;
    $role->save();

    $role->permissions()->sync($request->permission); // Menyinkronkan permission

    return redirect()->route('role')->with('success', 'Role updated successfully');
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $user = User::where('id', $id)->delete();

        return redirect()->back()->with('success', 'berhasil menghapus user');
    }
   
    public function role_destroy(string $id)
    {
        Role::where('id', $id)->delete();
        return redirect()->back()->with('success', 'berhasil menghapus role');
    }
}
