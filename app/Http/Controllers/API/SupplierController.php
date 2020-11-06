<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'shopname' => 'required| max:255 ',
            'phone' => 'required| min:10 | unique:suppliers',
            'address' => 'required',
        ]);

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . "." . $ext;
            $image = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'images/suppliers/';
            $image_url = $upload_path . $name;
            $image->save($image_url);

            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->shopname = $request->shopname;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->photo = $image_url;
            $supplier->save();
        } else {
            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->shopname = $request->shopname;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->save();
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
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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
            'email' => 'required | string | email | max:255 ',
            'shopname' => 'required| max:255 ',
            'phone' => 'required| min:10 ',
            'address' => 'required',
        ]);


        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->shopname = $request->shopname;
        $image = $request->newphoto;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time() . "." . $ext;
            $image = Image::make($image)->resize(240, 200);
            $upload_path = 'images/suppliers/';
            $image_url = $upload_path . $name;
            $success = $image->save($image_url);

            if ($success) {
                $supplier->photo = $image_url;
                $sup = Supplier::find($id);
                $image_path = $sup->photo;
                $done = unlink($image_path);
                $supplier->save();
            }
        } else {
            $supplier->photo = $request->photo;
            $supplier->save();
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
        $supplier = Supplier::find($id);
        $photo = $supplier->photo;
        if ($photo) {
            unlink($photo);
        }
        Supplier::destroy($id);
    }
}
