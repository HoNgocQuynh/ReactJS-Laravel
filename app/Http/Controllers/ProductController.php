<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function store(Request $request){
        $product = new Product;
        $product->productName = $request->productName;
        $product->catId = $request->catName;
        $product->slug = $request->slug;
        $product->brandId = $request->brandName;
        $product->detail = $request->detail;
        $product->price = $request->price;
        $product->salePrice = $request->salePrice;
        $product->popular = $request->popular;
        $product->status = $request->status;
        
        if ($request->hasFile('image'))
        {
              $file      = $request->file('image');
              $filename  = $file->getClientOriginalName();
              $extension = $file->getClientOriginalExtension();
              $picture   = date('His').'-'.$filename;
              //move image to public/img folder
              $file->move(public_path('img'), $picture);
              $product->image = $picture;
              //return response()->json(["data"=>$request->file('image') , "message" => "Image Uploaded Succesfully"]);
        } 
        $product->save();
        return response()->json(['status'=>200, 'data'=>'Create product successfully' ]);
    }
    public function index(){
        $products = Product::all();
        foreach ($products as $product){
            $product->catName = Category::where('id','=', $product->catId)->first()->catName;
            $product->brandName = Brand::where('id','=', $product->brandId)->first()->brandName;
        }
        return response()->json(['status'=>200, 'data'=>$products]);
    }
    public function edit($id){
        $product = Product::find($id);
        return response()->json(['status'=>200, 'data'=>$product]);
    }
    public function update(Request $request, $id){
        $product = Product::find($id);
        $product->productName = $request->productName;
        $product->catId = $request->catName;
        $product->slug = $request->slug;
        $product->brandId = $request->brandName;
        $product->detail = $request->detail;
        $product->price = $request->price;
        $product->popular = $request->popular;
        $product->salePrice = $request->salePrice;
        $product->status = $request->status;
        
        if ($request->hasFile('image'))
        {
              $file      = $request->file('image');
              $filename  = $file->getClientOriginalName();
              $extension = $file->getClientOriginalExtension();
              $picture   = date('His').'-'.$filename;
              //move image to public/img folder
              $file->move(public_path('img'), $picture);
              $product->image = $picture;
              //return response()->json(["data"=>$request->file('image') , "message" => "Image Uploaded Succesfully"]);
        } 
        $product->save();
        return response()->json(['status'=>200, 'data'=>$request->all()]);

    }
    public function destroy($id){
        $product = Product::find($id);
        Storage::delete($product->image);
        $product->forceDelete();
        
        return response()->json([
            'status' => 200,
            'message' => 'Product detroy Successfully'
        ]);
    }

    public function detail($id){
        $product = Product::find($id);
        $productsLike  = Product::where('catId', '=', $product->catId)->where('slug','!=', $product->slug)->inRandomOrder()->take(4)->get();
        return response()->json(['status'=>200, 'data'=>$product, 'productsLike'=>$productsLike]);
    }


    
    public function allCategory(){
        $categories = Category::where('status', '>', 0)->get();
        return response()->json(['status'=>200, 'data'=>$categories]);
    }
    public function allBrand(){
        $brands = Brand::where('status', '>', 0)->get();
        return response()->json(['status'=>200, 'data'=>$brands]);
    }

}
