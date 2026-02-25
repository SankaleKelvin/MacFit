<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //CRUD FUNCTIONS
    //Create
    public function createRole(Request $request){
        $validated = $request->validate([
            'name'=>'required|string|unique:roles,name',
            'description'=>'nullable|string|max:1000'
        ]);

        $role = new Role();
        $role->name = $validated['name'];
        $role->description = $validated['description'];
        try{
            $role->save();
            return response()->json([
                'message'=>'Role Saved Successfully.'
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Save a Role.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Read All Roles
    public function readAllRoles(){
        try{
            $roles = Role::all();
            return response()->json($roles);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch Roles.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }


    //Read Role(id)
    public function readRole($id){
        try{
            $role = Role::findOrFail($id);
            return response()->json($role);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch the Role.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Update role(id)
    public function updateRole(Request $request, $id){
        $validated = $request->validate([
            'name'=>'required|string|unique:roles,name',
            'description'=>'nullable|string|max:1000'
        ]);

        $role = Role::findOrFail($id);
        $role->name = $validated['name'];
        $role->description = $validated['description'];
        try{
            $role->save();
            return response()->json([
                'message'=>'Role Updated Successfully.'
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Update the Role.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }

    //Delete role(id)
    public function deleteRole($id){
        try{
            $role = Role::findOrFail($id);
            $role->delete();
            return response('Role Deleted Successfully');
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Delete the Role.',
                'message'=>$exception->getMessage()
            ], 200);
        }
    }
}
