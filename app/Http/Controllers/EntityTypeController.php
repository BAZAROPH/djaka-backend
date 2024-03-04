<?php

namespace App\Http\Controllers;

use App\Models\EntityTypes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\EntityTypeStoreRequest;
use App\Http\Requests\EntityTypeUpdateRequest;

class EntityTypeController extends Controller
{
    //

    public function index(){
        $entityTypes = EntityTypes::all();

        return response()->json($entityTypes, 200);
    }

    public function get(string $public_id){
        $entityType = EntityTypes::where('public_id', $public_id)->firstOrFail();

        return response()->json($entityType, 200);
    }

    public function store(EntityTypeStoreRequest $request){
        $validated = $request->validated();

        $validated['public_id'] = Str::random(10);

        $entityTypes = EntityTypes::create($validated);

        return response()->json($entityTypes, 200);
    }

    public function update(EntityTypeUpdateRequest $request, EntityTypes $entityType){
        $validated = $request->validated();

        $entityType->update($validated);

        return response()->json($entityType, 200);
    }

    public function delete(EntityTypes $entityType){
        $entityType->delete();

        $data = [
            'success' => true,
            'message' => 'Type d\'entité supprimé avec succès!'
        ];
        return response()->json($data, 200);
    }
}
