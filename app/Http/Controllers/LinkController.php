<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function store(Request $request){
        $link = new Link;
        $link->title = $request->title;
        $link->position = $request->position;
        $link->link = $request->url;
        $link->order = $request->order;
        $link->status = $request->status;
        $link->save();
        return response()->json(['status'=>200, 'message'=>'Created successfully']);
    }
    public function index(){
        $links = Link::all();
        return response()->json(['status'=>200, 'data'=>$links]);
    }

    public function edit($id){
        $link = Link::find($id);
        return response()->json(['status'=>200, 'data'=>$link]);
    }

    public function update(Request $request, $id){
        $link = Link::find($id);
        $link->title = $request->title;
        $link->position = $request->position;
        $link->link = $request->url;
        $link->order = $request->order;
        $link->status = $request->status;
        $link->save();
        return response()->json(['status'=>200, 'message'=>'Edit successfully']);
    }
    public function destroy($id){
        $link = Link::find($id);
        $link->forceDelete();
        
        return response()->json([
            'status' => 200,
            'message' => 'Link detroy Successfully'
        ]);
    }
}
