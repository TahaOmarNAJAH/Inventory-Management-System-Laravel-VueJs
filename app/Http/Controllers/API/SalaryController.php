<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SalaryResource;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    
    public function index()
    {
        $months = Salary::select('salary_mounth')->get();
        return response()->json($months);
    }

  

    public function pay(Request $request, $id)
    {
        $validateData = $request->validate([
            'salary_month' => 'required',
        ]);

        $month = $request->salary_month;
        $check = Salary::where('employee_id', $id)->where('salary_mounth', $month)->first();
        if ($check) {
            return response()->json('salary already paid');
        } else {
            $salary = new Salary();
            $salary->employee_id = $id;
            $salary->amount = $request->salary;
            $salary->salary_mounth = $month;
            $salary->salary_date = date('d/m/Y');
            $salary->salary_year = date('Y');
            $salary->save();
        }
    }

    public function salariesByMonth($month){
        $salaries = Salary::where('salary_mounth',$month)->get();
        return SalaryResource::collection($salaries);

    }

    public function edit($id){
        $salary = Salary::find($id);
        return new SalaryResource($salary);
    }

    public function SalaryUpdate(Request $request,$id){
        $validateData = $request->validate([
            'salary_month' => 'required',
        ]);

        $salary = Salary::find($id);
        $salary->employee_id = $request->employee_id;
        $salary->amount = $request->amount;
        $salary->salary_mounth = $request->salary_month;
        $salary->save();
    }
}
