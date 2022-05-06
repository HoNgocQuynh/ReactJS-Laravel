<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function catAtHome(){
        $categories = Category::where('status', '>', 0)->limit(7)->get();
        return response()->json(['status'=>200, 'data'=>$categories]);
    }
    public function popularCat(){
        $cat = Category::where('popular', '=' ,1)->where('status', '>=', 1)->orderBy('created_at', 'desc')->limit(3)->get();
        return response()->json([
            'status' => 200,
            'data' => $cat 
        ]);
    }
    
    
    public function productForSale()
    {
        $productForSale = Product::where('price','>','salePrice')->limit(5)->get();
        return response()->json(['status'=>200, 'productForSale'=>$productForSale]);
    }

    public function clothesShowHome(){
        $products = Product::where('catId','=','15')->where('status','>=','1')->limit(9)->get();
        return response()->json(['status'=>200, 'data'=>$products]);
    }

    public function electronicsShowHome(){
        $products = Product::where('catId','=','16')->where('status','>=','1')->limit(9)->get();
        return response()->json(['status'=>200, 'data'=>$products]);
    }
    public function recommendedItem(){
        $products = Product::where('status','>=','1')->orderBy('created_at', 'DESC')->limit(12)->get();
        return response()->json(['status'=>200, 'data'=>$products]);
    }
    public function productByCat($id){
        $products = Product::where('catId', '=', $id)->where('status','>=','1')->limit(8)->get();
        $catName = Category::where('id', '=', $id)->select('catName')->get();
        return response()->json(['status'=>200, 'data'=>$products, 'title'=>$catName]);
    }
}
