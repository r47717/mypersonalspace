<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return [
            'products' => Product::with('tags')->where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function new(Request $request)
    {
        $product = new Product;
        $product->user_id = Auth::user()->id;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->save();

        if (!empty(trim($request->tags))) {
            $tags = explode(" ", $request->tags);
            foreach ($tags as $tag) {
                $product->tags()->attach($tag);
            }
        }

        return [
            'success' => true,
            'message' => 'New product has been added',
        ];
    }
}
