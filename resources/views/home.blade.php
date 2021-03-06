@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container justify-content-center pb-5">
    <div class="row gx-5 gy-4">
        @if(count($products) == 0)
            <h1>There is no products</h1>
        @endif

        @foreach ($products as $product)
            <div class="col-4">
                <img class="d-block rounded-2" src="{{ Storage::url($product->image) }}" height="400" width="400" alt="" />
                <div class="px-3 py-3 bg-white rounded-2">
                    <h4>{{ $product->title }}</h4>
                    <p>{{ $product->description }}</p>
                    @guest
                        <a href="/product/{{ $product->id }}" class="btn btn-primary w-100 mt-3">product detail</a>
                    @else
                        @if(Auth::user()->role == 2)
                            <a href="/admin/product/edit/{{ $product->id }}" class="btn btn-danger w-100">Update Product</a>
                        @endif
                        <a href="/product/{{ $product->id }}" class="btn btn-primary w-100 mt-3">product detail</a>
                    @endguest
                </div>
            </div>       
        @endforeach
    </div>

   <div class="d-felx justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection
