<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function show($slug)
    {  
        $product = Product::query()->whereSlug($slug)->first();
        // $product = Product::find($id);
        // dd($product);

        // dd($product);
        return view('show', compact('product'));
    }

    public function store(Request $request)
    {
        // Save Data Product
        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
        ]);

        // Get ID Product
        $link = env('APP_URL_QRCODE', 'http://localhost:8000/show/');


       $product->update([
            'link' => $link.$product->slug,
       ]);

        return redirect()->back();
    }
}
