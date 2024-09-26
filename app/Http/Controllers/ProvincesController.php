<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvincesController extends Controller
{
    public function index()
    {
        $provinces = Province::withCount(['employees'])->get();

        return view('provincespage', compact('provinces'));
    }



    public function showByCity($cityId)
    {
        $provinces = Province::where('city_id', $cityId)
            ->withCount(['employees'])
            ->get();

        // if ($provinces->isEmpty()) {
        //     dd("No provinces found for city ID: {$cityId}");
        // }

        return view('provincespage', compact('provinces'));
    }

    public function destroy($id)
    {
        $province = Province::findOrFail($id);

        $province->delete();

        return response()->json(['success' => true]);
    }
}
