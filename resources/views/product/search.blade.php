@extends('layouts.app')

@section('content')

<div class="container justify-content-center pb-5">
    <form class="d-flex flex-row justify-content-between mb-4 w-75" method="POST" action="{{ url('/search/product') }}">
        @csrf
        
        <label for="category" class="form-label text-md-right mt-3">{{ __('Search: ') }}</label>

        <select id="category" class="form-select w-25" name="category" aria-label="Select Category">
            @foreach ($categories as $category)
                <option @if($input == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <input id="name" type="text" class="form-control w-50" name="name" value="{{ $name }}" autocomplete="name" autofocus>

        <button type="submit" class="btn btn-primary px-5">
            {{ __('Search') }}
        </button>
    </form>

    <div class="row gx-5 gy-4">
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
