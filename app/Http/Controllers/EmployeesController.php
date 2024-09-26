<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::with('province')->get();
        return view('employeespage', compact('employees'));
    }

    public function showByProvince($provinceId)
    {
        // Retrieve employees for the specified province
        $employees = Employee::where('province_id', $provinceId)->get();

        return view('employeespage', compact('employees'));
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        $employee->delete();

        return response()->json(['success' => true]);
    }
}
