<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    public function store(Request $request){
        $brand = new Brand;
        $brand->brandName = $request->brandName;
        $brand->slug = $request->slug;
        $brand->description = $request->description;
        $brand->status = $request->status;
        $brand->save();
        return response()->json(['status'=>200, 'message'=>'Created successfully']);
    }
    public function index(){
        $brands = Brand::all();
        return response()->json(['status'=>200, 'data'=>$brands]);
    }
    public function edit($id){
        $brand = Brand::find($id);
        return response()->json(['status'=>200, 'data'=>$brand]);
    }
    public function update(Request $request, $id){
        $brand = Brand::find($id);
        $brand->brandName = $request->brandName;
        $brand->slug = $request->slug;
        $brand->description = $request->description;
        $brand->status = $request->status;
        $brand->save();
        return response()->json(['status'=>200, 'message'=>'Edit successfully']);
    }
    public function destroy($id){
        $brand = Brand::find($id);
        $brand->forceDelete();
        
        return response()->json([
            'status' => 200,
            'message' => 'Brand detroy Successfully'
        ]);
    }
}
