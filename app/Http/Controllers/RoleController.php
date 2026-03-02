<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function createRole(Request $request)
    {
        $this->authorize('create', Role::class);

        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'description' => 'nullable|string|max:1000'
        ]);

        $role = new Role();
        $role->name = $validated['name'];
        $role->description = $validated['description'] ?? null;

        $role->save();

        return response()->json(['message' => 'Role Saved Successfully.'], 200);
    }

    public function readAllRoles()
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::all();
        return response()->json($roles);
    }

    public function readRole($id)
    {
        $role = Role::findOrFail($id);
        $this->authorize('view', $role);

        return response()->json($role);
    }

    public function updateRole(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $this->authorize('update', $role);

        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
            'description' => 'nullable|string|max:1000'
        ]);

        $role->name = $validated['name'];
        $role->description = $validated['description'] ?? null;
        $role->save();

        return response()->json(['message' => 'Role Updated Successfully.'], 200);
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $this->authorize('delete', $role);

        $role->delete();
        return response()->json(['message' => 'Role Deleted Successfully']);
    }
}
