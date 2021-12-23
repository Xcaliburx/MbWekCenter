@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container justify-content-center">
    <table class="table table-dark table-borderless border">
        <thead>
          <tr>
              <th class="text-center" scope="col">No</th>
              <th scope="col">Item Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Sub Total</th>
              <th>Delete</th>
          </tr>
        </thead>
        <tbody>
            @if(count($carts) == 0)
                <tr class="table-light">
                    <td>No Cart Data</td>
                </tr>
            @endif

            @foreach ($carts as $cart)
                <tr class="table-light">
                    <th scope="row" style="width: 10%" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $cart->title }}</td>
                    <td>{{ $cart->price }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>{{ $cart->subTotal }}</td>

                    <form method="POST" action="{{ url('/user/cart/delete', $cart->id) }}">
                        @csrf
                        @method('DELETE')
                        <td style="width: 15%">
                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')" type="submit">Delete</button>
                        </td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="float-end">
        <p>Grand Total : Rp. {{ $total }}</p>
        <button class="btn btn-primary float-end" type="button">Checkout</button>
    </div>
</div>
@endsection