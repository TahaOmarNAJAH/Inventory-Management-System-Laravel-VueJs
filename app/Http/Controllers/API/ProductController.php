<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
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
            'category_id' => 'required',
            'selling_price' => 'required| not_in:0 |numeric ',
            'product_quantity' => 'required| not_in:0 |numeric ',
        ]);

        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . "." . $ext;
            $image = Image::make($request->image)->resize(240, 200);
            $upload_path = 'images/products/';
            $image_url = $upload_path . $name;
            $image->save($image_url);

            $product = new Product();
            $product->name = $request->name;
            $product->code = $request->code;
            $product->root = $request->root;
            $product->selling_price = $request->selling_price;
            $product->buying_price = $request->buying_price;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->image = $image_url;
            $product->save();
        } else {
            $employee = new Employee();
            $product->name = $request->name;
            $product->code = $request->code;
            $product->root = $request->root;
            $product->selling_price = $request->selling_price;
            $product->buying_price = $request->buying_price;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
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
        $product = Product::find($id);
        return new ProductResource($product);
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
            'category_id' => 'required',
            'selling_price' => 'required| not_in:0 |numeric ',
            'product_quantity' => 'required| not_in:0 |numeric ',
        ]);
        
        $product = Product::find($id);
        $product->name = $request->name;
        $product->code = $request->code;
        $product->root = $request->root;
        $product->selling_price = $request->selling_price;
        $product->buying_price = $request->buying_price;
        $product->buying_date = $request->buying_date;
        $product->product_quantity = $request->product_quantity;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $image = $request->newimage;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time() . "." . $ext;
            $image = Image::make($image)->resize(240, 200);
            $upload_path = 'images/products/';
            $image_url = $upload_path . $name;
            $success = $image->save($image_url);

            if ($success) {
                $product->image = $image_url;
                $emp = Product::find($id);
                $image_path = $emp->image;
                $done = unlink($image_path);
                $product->save();
            }
        } else {
            $product->image = $request->image;
            $product->save();
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
        $product = Product::find($id);
        $photo = $product->image;
        if ($photo) {
            unlink($photo);
        }
        Product::destroy($id);
    }
}
