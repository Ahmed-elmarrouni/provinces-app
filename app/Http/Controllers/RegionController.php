<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::withCount(['cities', 'provinces'])->get();
        return view('dashboard', compact('regions'));
    }

    public function destroy($id)
    {
        $region = Region::findOrFail($id);

        // Optional: Add any additional logic (e.g., cascade delete related data)
        $region->delete();

        return response()->json(['success' => true]);
    }
}
