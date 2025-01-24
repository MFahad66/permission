<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){

        // $roles = Role::all();
        $roles = Role::orderBy('name','ASC')->get();
        
        return view('roles.list',[
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $permissions = Permission::orderBy('name','ASC')->get();
        // $permissions = Permission::all();

        return view('roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }
    
        $role = Role::create(['name' => $request->name]);
    
        if (!empty($request->permissions)) {
            foreach ($request->permissions as $permissionName) {
                $role->givePermissionTo($permissionName);
            }
        }
    
        return redirect()->route('roles.list')->with('success', 'Role Added Successfully!');
    }
    
    

    public function edit($id)
    {
        $role =Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name','ASC')->get();

        return view('roles.edit',[
            'hasPermissions' => $hasPermissions,
            'permissions' => $permissions,
            'role'=> $role
        ]);
      
    }
    

    public function update(Request $request ,$id){
    
        $role = Role::findOrFail($id);

          $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$id.' ,id',
        ]);

        if ($validator->passes()) {
            $role->name = $request->name;
            $role->save();

            if (!empty($request->permissions)) {
                $role->syncPermissions($request->permissions);
            }else{
                $role->syncPermissions([]);

            }

            return redirect()->route('roles.list')->with('success','Role Updated SuccessFully!'); 
        } else {
            return redirect()->route('roles.edit',$id)->withErrors($validator);
        }
    }
    
    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            session()->flash('error','Role not Found');
            return response()->json([
                'status' => false,
            ]);
        }

        $role->delete();

        session()->flash('success','Role Deleted SuccessFuly');
        return response()->json([
            'status' => true,
         
        ]);
    }
}
