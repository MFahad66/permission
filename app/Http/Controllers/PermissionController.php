<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){

        $permissions = Permission::all();
        
        return view('permissions.list',compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3',
        ]);

        if ($validator->passes()) {
            Permission::create(['name' => $request->name]);
            return redirect()->route('permissions.list')->with('success','Permission Added SuccessFully!'); 
        } else {
            return redirect()->route('permissions.create')->withErrors($validator);
        }
    }

    public function edit($id){
        $permission = Permission::find($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request ,$id){

        $permission = Permission::findOrFail($id);

          $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,'.$id.' ,id',
        ]);

        if ($validator->passes()) {
            $permission->name = $request->name;
            $permission->save();
            return redirect()->route('permissions.list')->with('success','Permission Updated SuccessFully!'); 
        } else {
            return redirect()->route('permissions.edit',$id)->withErrors($validator);
        }
    }
    
    public function destroy($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json([
                'status' => false,
                'message' => 'Permission not found.'
            ]);
        }

        $permission->delete();

        return response()->json([
            'status' => true,
            'message' => 'Permission deleted successfully.'
        ]);
    }
}
