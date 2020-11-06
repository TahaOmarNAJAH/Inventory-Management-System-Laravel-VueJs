<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Image;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required | string | max:255',
            'email' => 'required | string | email | max:255 | unique:users',
            'salary' => 'required| not_in:0 |numeric ',
            'phone' => 'required| min:10 | unique:employees',
            'joining_date' => 'required',
            'address' => 'required',
        ]);

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . "." . $ext;
            $image = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'images/employees/';
            $image_url = $upload_path . $name;
            $image->save($image_url);

            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->salary = $request->salary;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;
            $employee->photo = $image_url;
            $employee->save();
        } else {
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->salary = $request->salary;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;
            $employee->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required | string | max:255',
            'email' => 'required | string | email | max:255',
            'salary' => 'required| not_in:0 |numeric ',
            'phone' => 'required| min:10 ',
            'joining_date' => 'required',
            'address' => 'required',
        ]);

        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->salary = $request->salary;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->nid = $request->nid;
        $employee->joining_date = $request->joining_date;
        $image = $request->newphoto;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time() . "." . $ext;
            $image = Image::make($image)->resize(240, 200);
            $upload_path = 'images/employees/';
            $image_url = $upload_path . $name;
            $success = $image->save($image_url);

            if ($success) {
                $employee->photo = $image_url;
                $emp = Employee::find($id);
                $image_path = $emp->photo;
                $done = unlink($image_path);
                $employee->save();
            }
        }else{
            $employee->photo = $request->photo;
            $employee->save();
        }

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $employee = Employee::find($id);
        $photo = $employee->photo;
        if ($photo) {
            unlink($photo);
        }
        Employee::destroy($id);
    }
}
