@extends('layouts.app')

@section('content')
<div class="container justify-content-center pb-5">
    <div class=" d-flex flex-row">
        <div>
            <img class="d-block rounded-2" src="{{ Storage::url($product->image) }}" height="400" width="400" alt="" />
        </div>
        <div class="ms-5 mt-4">
            <h3>{{ $product->title }}</h3>
            <h4>Description :</h4>
            <textarea class="form-control" cols="100" disabled>{{ $product->description }}</textarea>
            <h4 class="mt-3">Stock :</h4>
            <p>{{ $product->stock }}</p>
            <h3>Price :</h3>
            <p>Rp. {{ $product->price }}</p>

            @auth
                @if(Auth::user()->role == 1)
                    <h3 class="mt-5">Add To Cart</h3>
                    <form class="ms-4" method="POST" action="{{ url('/user/cart/add', $product->id) }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="quantity" class="col-md-1 col-form-label text-md-right">{{ __('Quantity: ') }}</label>

                            <div class="col ms-4">
                                <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required autofocus>

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary px-5">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection