<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::withCount(['provinces', 'employees'])->get();

        return view('citiespage', compact('cities'));
    }


    public function showByRegion($regionId)
    {
        $cities = City::where('region_id', $regionId)
            ->withCount(['provinces', 'employees'])
            ->get();

        return view('citiespage', compact('cities'));
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json(['success' => true]);
    }
}
