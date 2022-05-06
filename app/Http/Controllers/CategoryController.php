<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request){
        $category = new Category;
        $category->catName = $request->catName;
        $category->slug = $request->slug;
        $category->parentId = $request->parentId;
        $category->description = $request->description;
        $category->popular = $request->popular;
        $category->status = $request->status;
        $category->save();
        return response()->json(['status'=>200, 'data'=>'Create Category Successfull' ]);
    }

    public function index() {
        $categories = Category::all();
        return response()->json(['status'=>200, 'data'=>$categories]);
    }

    public function edit($id){
        $category = Category::find($id);
        return response()->json(['status'=>200, 'data'=>$category]);
    }

    public function update(Request $request,$id){
        $category = Category::find($id);
        $category->catName = $request->catName;
        $category->slug = $request->slug;
        $category->parentId = $request->parentId;
        $category->description = $request->description;
        $category->popular = $request->popular;
        $category->status = $request->status;
        $category->save();
        return response()->json(['status'=>200, 'message'=>'Updated category successfully']);

    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->forceDelete();
        return response()->json([
            'status' => 200,
            'message' => 'Category detroy Successfully'
        ]);
    }
    
}
