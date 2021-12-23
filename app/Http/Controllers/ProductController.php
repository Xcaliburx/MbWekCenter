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

        return redirect('/home')->with('success',' Insert Product Success!');
    }

    public function home(){
        $products = Product::paginate(6);

        return view('home', ['products' => $products]);
    }

    public function detail($id){
        $product = Product::where('id', $id)->first();

        return view('product.detail', ['product' => $product]);
    }

    public function edit($id){
        $categories = Category::all();
        $product = Product::where('id', $id)->first();

        $data = [
            'categories' => $categories,
            'product' => $product
        ];

        return view('product.edit', $data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'categoryId' => 'required',
            'title' => 'required|min:5|max:25',
            'description' => 'required|min:10|max:100',
            'price' => 'required|numeric|gte:1000|lte:10000000',
            'stock' => 'required|gte:1' 
        ]);

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|max:2048|mimes:jpg,png,jpeg,gif,svg'  
            ]);
            
            $path = $request->file('image')->store('public/images');

            Product::where('id', $id)->update([
                'image' => $path
            ]);
        }

        Product::where('id', $id)->update([
            'categoryId' => $request->input('categoryId'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock')
        ]);

        return redirect('/home')->with('success',' Update Product Success!');
    }

    public function search(Request $request){
        $categories = Category::all();

        $category = $request->input('category');
        $name = $request->input('name');

        $products;
        if($name == null && $category == null){
            $products = Product::paginate(6);
        }
        else if($name == null){
            $products = Product::where('categoryId', $category)->paginate(6);
        }
        else{
            $products = Product::where('categoryId', $category)
            ->where('title', $name)
            ->paginate(6);
        }

        $data = [
            'categories' => $categories,
            'products' => $products,
            'input' => $category,
            'name' => $name
        ];

        return view('product.search', $data);
    }
}
