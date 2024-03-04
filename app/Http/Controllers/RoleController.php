<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{
    //

    public function index(){

        $role = Roles::all();

        return response()->json($role, 200);
    }

    public function get(string $public_id ){

        $role = Roles::where('public_id', $public_id)->firstOrFail();

        return response()->json($role, 200);
    }

    public function store(RoleStoreRequest $request){

        $validated = $request->validated();

        $validated['public_id']=Str::random(10);

        $role = Roles::create($validated);

        return response()->json($role, 200);

    }
    public function update(RoleUpdateRequest $request, Roles $role){

        $validated = $request->validated();

        $role->update($validated);

        return response()->json($role, 200);

    }
    public function delete(Roles $role){

        $role->delete();

        $data = [
            'succes'=> true,
            'message'=>'Role supprimé avec succès'
        ];

        return response()->json($data, 200);

    }
}
