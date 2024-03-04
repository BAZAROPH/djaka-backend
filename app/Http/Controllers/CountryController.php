<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CountryStoreRequest;
use App\Http\Requests\CountryUpdateRequest;

class CountryController extends Controller
{
    //

    public function index(){
        $countries = Countries::all();

        return response()->json($countries, 200);
    }

    public function get(string $public_id){

        $country = Countries::where('public_id', $public_id)->firstOrFail();

        return response()->json($country, 200);
    }

    public function store(CountryStoreRequest $request){
        $validated = $request->validated();

        $validated['public_id'] = Str::random(10);

        $country = Countries::create($validated);

        return response()->json($country, 200);
    }

    public function update(CountryUpdateRequest $request, Countries $country){
        $validated = $request->validated();

        $country->update($validated);

        return response()->json($country, 200);
    }

    public function delete(Countries $country){
        $country->delete();

        $data = [
            'succes' => true,
            'message' => 'Pays supprimé avec succès !'
        ];

        return response()->json($data, 200);
    }
}
