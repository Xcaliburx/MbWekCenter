@extends('layouts.app')

@section('content')

<div class="container justify-content-center">
    <h3>Transaction Detail</h3>
    <table class="table table-dark table-borderless border">
        <thead>
          <tr>
              <th scope="col">No</th>
              <th scope="col">Item Name</th>
              <th scope="col">Item Detail</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">SubTotal</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
              <tr class="table-light">
                <th scope="row" style="width: 5%">{{ $loop->iteration }}</th>
                <td style="width: 15%">{{ $transaction->title }}</td>
                <td>{{ $transaction->description }}</td>
                <td style="width: 10%">{{ $transaction->price }}</td>
                <td style="width: 10%">{{ $transaction->quantity }}</td>
                <td style="width: 10%">{{ $transaction->subTotal }}</td>
              </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="float-end">
        <p>Grand Total : Rp. {{ $total }}</p>
    </div>
</div>
@endsection