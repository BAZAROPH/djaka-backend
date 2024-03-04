<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CityStoreRequest;
use App\Http\Requests\CityUpdateRequest;

class CityController extends Controller
{
    //
    public function index(){

        $cities = Cities::all();

        return response()->json( $cities,200);
    }

    public function get(string $public_id){

        $city = Cities::where('public_id', $public_id)->firstOrFail();

        return response()->json($city, 200);
    }

    public function store(CityStoreRequest $request){

        $validated = $request->validated();

        $validated['public_id'] = Str::random(10);

        $city = Cities::create($validated);

        return response()->json($city, 200);
    }

    public function update(CityUpdateRequest $request, Cities $city){

        $validated = $request->validated();

        $city->update($validated);

        return response()->json($city, 200);
    }

    public function delete(Cities $city){
        $city->delete();

        $data = [
            'succes' => true,
            'message' => 'Ville supprimée avec succès !'
        ];

        return response()->json($data, 200);
    }
}
