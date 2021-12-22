<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index(){
        $categories = Category::all();

        return view('product.insert', ['categories' => $categories]);
    }

    public function insert(Request $request){
        $request->validate([
            'categoryId' => 'required',
            'title' => 'required|min:5|max:25',
            'description' => 'required|min:10|max:100',
            'price' => 'required|numeric|gte:1000|lte:10000000',
            'stock' => 'required|gte:1',
            'image' => 'required|image|max:2048|mimes:jpg,png,jpeg,gif,svg'      
        ]);

        $path = $request->file('image')->store('public/images');

        Product::create([
            'categoryId' => $request->input('categoryId'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'image' => $path
        ]);

        return redirect('/admin/product/insert')->with('success',' Insert Success!');
    }

    public function home(){
        $products = Product::paginate(6);

        return view('home', ['products' => $products]);
    }
}
