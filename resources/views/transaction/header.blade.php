@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container justify-content-center">
    <h3>Transaction</h3>
    <table class="table table-dark table-borderless border">
        <thead>
          <tr>
              <th scope="col">No</th>
              <th scope="col">Transaction Time</th>
              <th scope="col">Detail Transaction</th>
          </tr>
        </thead>
        <tbody>
            @if(count($transactions) == 0)
                <tr class="table-light">
                    <td>No Transaction Data</td>
                </tr>
            @endif

            @foreach ($transactions as $transaction)
              <tr class="table-light">
                <th scope="row" style="width: 10%">{{ $loop->iteration }}</th>
                <td>{{ $transaction->dateOrder }}</td>

                <td>
                    <a class="btn btn-primary" href="/user/transaction/{{ $transaction->id }}">Check Detail</a>
                </td>
              </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection