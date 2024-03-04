<?php

namespace App\Http\Controllers;

use App\Models\Entities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\EntityStoreRequest;
use App\Http\Requests\EntityUpdateRequest;

class EntityController extends Controller
{
    //
    public function index(){
        $entities = Entities::all();

        return response()->json($entities, 200);
    }

    public function get(string $public_id){
        $entity = Entities::where('public_id', $public_id)->firstOrFail();

        return response()->json($entity, 200);
    }

    public function store(EntityStoreRequest $request){
        $validated = $request->validated();

        $validated['public_id'] = Str::random(10);

        $entity = Entities::create($validated);

        return response()->json($entity, 200);
    }

    public function update(EntityUpdateRequest $request, Entities $entity){
        $validated = $request->validated();

        $entity->update($validated);

        return response()->json($entity, 200);
    }

    public function delete(Entities $entity){
        $entity->delete();

        $data = [
            'success' => true,
            'message' => 'Type d\'entité supprimé avec succès!'
        ];

        return response()->json($data, 200);
    }
}
