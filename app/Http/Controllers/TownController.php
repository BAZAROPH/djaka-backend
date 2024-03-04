<?php

namespace App\Http\Controllers;

use App\Models\Towns;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\TownStoreRequest;
use App\Http\Requests\TownUpdateRequest;

class TownController extends Controller
{
    //

    public function index(){
        $towns = Towns::all();

        return response()->json($towns, 200);
    }

    public function get(string $public_id){
        $town = Towns::where('public_id', $public_id)->firstOrFail();

        return response()->json($town, 200);
    }

    public function store(TownStoreRequest $request){
        $validated = $request->validated();

        $validated['public_id'] = Str::random(10);

        $town = Towns::create($validated);

        return response()->json($town, 200);
    }

    public function update(TownUpdateRequest $request, Towns $town){
        $validated = $request->validated();

        $town->update($validated);

        return response()->json($town, 200);
    }

    public function delete(Towns $town){
        $town->delete();

        return response()->json($town, 200);
    }
}
