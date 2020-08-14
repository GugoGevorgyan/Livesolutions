<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'images.*' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:255',
        ]);

        $images=array();
        if($files = $request->file('images')){
            foreach($files as $file){
                $name=time().$file->getClientOriginalName();
                $file->storeAs('images', $name);
                $images[]=$name;
            }
        }

        Product::insert( [
            'image'=>  json_encode($images),
            'description' =>$request->description,
            'name' => $request->name
        ]);
        return 'Your product has been sent';
    }
}
