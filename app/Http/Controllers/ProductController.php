<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:255',
        ]);
        if(isset($request->image) && $request->image->getClientOriginalName()){
            $ext = $request->image->getClientOriginalExtension();
            $file = time()."."."$ext";
            $request->image->storeAs('public/images', $file);
        }
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->image = $file;
        $product->description = $validatedData['description'];
        $product->save();
        return $product;
    }
}
