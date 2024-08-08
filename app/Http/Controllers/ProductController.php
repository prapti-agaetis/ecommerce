<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
   
    public function home(Request $request){

         $currency = $request->input('currency','USD');
        $products = Product::paginate(5);
      
       
        return view('welcome', compact('products'));
        
    }
    
   

    public function sort(Request $request)
    {
        $sortBy = $request->input('sort_by', 'relevance');
        $sortOrder = $this->getSortOrder($sortBy);
    
        $products = Product::query();
    
        if ($request->has('gender')) {
            $products->where('gender', $request->input('gender'));
        }
        
        $products = $products->orderBy($sortOrder['column'], $sortOrder['direction'])
            ->paginate(5) 
            ->appends($request->except('page'));
            
            foreach ($products as $product) {
                $product->converted_price = $this->currencyConverter->convert($product->price, 'USD', $currency);
            }
        return view('welcome', compact('products', 'sortBy'));
    }
    public function getSortOrder($sortBy)
{
    switch ($sortBy) {
        case 'name_asc':
            return ['column' => 'name', 'direction' => 'asc'];
        case 'name_desc':
            return ['column' => 'name', 'direction' => 'desc'];
        case 'price_asc':
            return ['column' => 'price', 'direction' => 'asc'];
        case 'price_desc':
            return ['column' => 'price', 'direction' => 'desc'];
        default:
            return ['column' => 'id', 'direction' => 'desc']; 
    }
}
  }





























   
//        public function index(Request $request)
// {
//     $sortBy = $request->query('sort_by', 'relevance');
//     $sortOrder = $request->query('sort_order', 'desc');

//     $products = Product::orderBy($sortBy, $sortOrder);

//     return view('welcome', compact('products', 'sortBy', 'sortOrder'));
// }
    

//     public function getSortColumn($sortBy)
//     {
//         switch ($sortBy) {
//             case 'price_asc':
//                 return 'price';
//             case 'price_desc':
//                 return 'price';
//             case 'popularity':
//                 return 'popularity';
//             case 'rating':
//                 return 'rating';
//             case 'relevance':
//                 return 'created_at';
//             default:
//                 return 'created_at';
//         }
//     }
//   }





    // This method will show products page
    // public function index() {
    //     $products = Product::orderBy('created_at','DESC')->get();

    //     return view('products.list',[
    //         'products' => $products
            
    //     ]);
    // }
    
    //   public function Admin()
    // {
    //     return redirect()->route('products.index') ;
    // }

    // // This method will show create product page
    // public function create() {
    //     return view('products.create');
    // }

    // // This method will store a product in db
    // public function store(Request $request) {
    //     $rules = [
    //         'name' => 'required|min:5',
    //         'sku' => 'required|min:3',
    //         'price' => 'required|numeric'            
    //     ];

    //     if ($request->image != "") {
    //         $rules['image'] = 'image';
    //     }

    //     $validator = Validator::make($request->all(),$rules);

    //     if ($validator->fails()) {
    //         return redirect()->route('products.create')->withInput()->withErrors($validator);
    //     }

    //     // here we will insert product in db
    //     $product = new Product();
    //     $product->name = $request->name;
    //     $product->sku = $request->sku;
    //     $product->price = $request->price;
    //     $product->description = $request->description;
    //     $product->save();

    //     if ($request->image != "") {
    //         // here we will store image 
    //         $image = $request->image;
    //         $ext = $image->getClientOriginalExtension();
    //         $imageName = time().'.'.$ext; // Unique image name

    //         // Save image to products directory
    //         $image->move(public_path('uploads/products'),$imageName);

    //         // Save image name in database products
    //         $product->image = $imageName;
    //         $product->save();
    //     }        

    //     return redirect()->route('products.index')->with('success','Product added successfully.');
    // }

    // // This method will show edit product page
    // public function edit($id) {
    //     $product = Product::findOrFail($id);
    //     return view('products.edit',[
    //         'product' => $product
    //     ]);
    // }

    // // This method will update a product
    // public function update($id, Request $request) {

    //     $product = Product::findOrFail($id);

    //     $rules = [
    //         'name' => 'required|min:5',
    //         'sku' => 'required|min:3',
    //         'price' => 'required|numeric'            
    //     ];

    //     if ($request->image != "") {
    //         $rules['image'] = 'image';
    //     }

    //     $validator = Validator::make($request->all(),$rules);

    //     if ($validator->fails()) {
    //         return redirect()->route('products.edit',$product->id)->withInput()->withErrors($validator);
    //     }

    //     // here we will update product
    //     $product->name = $request->name;
    //     $product->sku = $request->sku;
    //     $product->price = $request->price;
    //     $product->description = $request->description;
    //     $product->save();

    //     if ($request->image != "") {

    //         // delete old image
    //         File::delete(public_path('uploads/products/'.$product->image));

    //         // here we will store image
    //         $image = $request->image;
    //         $ext = $image->getClientOriginalExtension();
    //         $imageName = time().'.'.$ext; // Unique image name

    //         // Save image to products directory
    //         $image->move(public_path('uploads/products'),$imageName);

    //         // Save image name in database
    //         $product->image = $imageName;
    //         $product->save();
    //     }        

    //     return redirect()->route('products.index')->with('success','Product updated successfully.');
    // }

    // // This method will delete a product
    // public function destroy($id) {
    //     $product = Product::findOrFail($id);

    //    // delete image
    //    File::delete(public_path('uploads/products/'.$product->image));

    //    // delete product from database
    //    $product->delete();

    //    return redirect()->route('products.index')->with('success','Product deleted successfully.');
    // }
   

