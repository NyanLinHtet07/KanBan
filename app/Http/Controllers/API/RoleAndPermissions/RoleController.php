<?php

namespace App\Http\Controllers\API\RoleAndPermissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')
                        ->get();
        
        $headers = "Get All Role Datas";
        
        return response()->json([
                'data' => $roles, 
               
                'message' => $headers
            ],  200);
    }


    public function store(Request $request)
    {
        $request -> validate ([
            'role' => 'required',
            'description' => 'nullable'
        ]);

        $roles = Role::create($request -> only('role', 'description'));
        $headers =  "Successfully Uploaded";

        return response()->json([
            'data' => $roles, 
            'messaage' => $headers
        ],201 );
    }

    public function show($id)
    {
        $role = Role::find($id);

        if(!$role) {
            return response()->json([
               'message' => 'Role not found'], 404);
        }

        return response()->json([
            'data' => $role
        ]);
    }

   
    public function update(Request $request, $id)
    {
        $request -> validate ([
            'role' => 'nullable',
            'description' => 'nullable'
        ]);

        $role = Role::find($id);

        if(!$role) {
            return response()->json([
               'message' => 'Role not found'], 404);
        }

        $role -> update($request -> only ('role', 'description'));

        $headers =  "Successfully Updated";
        return response()->json([ 'data' =>$role, 'message' => $header]);

    }

   
    public function destroy($id)
    {
        $role = Role::find($id);
        $role -> delete();

        return response()->json(['message' => 'Role Deleted Successfully']);
    }
}
