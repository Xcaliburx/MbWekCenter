@extends('layouts.app')

@section('content')
<div class="container">
   @foreach ($products as $product)
     <img class="d-block" src="{{ Storage::url($product->image) }}" height="200" width="200" alt="" />
     <p>{{ $product->title }}</p>
     <p>{{ $product->description }}</p>
   @endforeach

   <div class="d-felx justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection
