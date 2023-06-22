<?php

namespace App\Http\Controllers\API\RoleAndPermissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::with('roles')
                                    ->orderBy('id', 'DESC')
                                    ->get();
        
        $message = "Get All Permission Data";
        
        return response()->json([
            'data' => $permissions,
            'message' => $message], 200);
    }

    public function store(Request $request)
    {
        $request -> validate ([
            'permission' => 'required',
            'description' => 'nullable'
        ]);

        $permission = Permission::create($request -> only('permission', 'description'));
        $permission -> roles() -> attach($request -> input('roles'));

        $message = "Successfully Uploaded";

        return response()->json([
            'data' => $permission,
            'message' => $message,
        ], 201);
    }

    public function show($id)
    {
        $permission = Permission::with('roles')->findOrFail($id);

        if(! $permission){
            return response() -> json([
                'message' => 'Permission not Found'
            ], 404);
        }

        return response() -> json(['data' => $permission]);
    }


    public function update(Request $request, $id)
    {
        $request -> validate ([
            'permission' => 'required',
            'description' => 'nullable'
        ]);

        $permission = Permission::find($id);

        if(! $permission){
            return response() -> json([
                'message' => 'Permission is not found'
            ], 404);
        }

        $permission -> update($request -> only('permission', 'description'));

        $permission -> roles() -> sync($request -> input('roles'));

        $message = "Successfully Updated";
        return response() -> json(['data' => $permission,
                                   'message' => $message]);
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);

        $permission->roles()->detach();
        $permission -> delete();

        return response() -> json (['message' => 'Permission Dataed Successfully']);
    }
}
