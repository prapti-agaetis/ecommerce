<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
  
   public function index() {
  
      $products = Product::latest()->get(); 
    return view('admin.list', compact('products'));
    }

    

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
             'gender' => 'required|in:male,female',
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.create')->withInput()->withErrors($validator);
        }

   
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->gender= $request->gender;
        $product->size= $request->size;
        $product->save();

        if ($request->image != "") {
          
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; 

            $image->move(public_path('uploads/products'), $imageName);

           
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('admin.index')->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', [
            'product' => $product
        ]);
    }

    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
            'gender' => 'required|in:male,female',
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.edit', $product->id)->withInput()->withErrors($validator);
        }

       
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
         $product->gender= $request->gender;
          $product->size= $request->size;

        $product->save();

        if ($request->image != "") {
     
            File::delete(public_path('uploads/products/'.$product->image));

           
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;

          
            $image->move(public_path('uploads/products'), $imageName);

           
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('admin.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        File::delete(public_path('uploads/products/'.$product->image));
       
        $product->delete();

        return redirect()->route('admin.index')->with('success', 'Product deleted successfully.');
    }
}