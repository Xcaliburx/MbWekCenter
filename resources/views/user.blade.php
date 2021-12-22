@extends('layouts.app')

@section('content')

<div class="container justify-content-center">
    <table class="table table-light table-borderless border">
        <thead>
          <tr>
              <th class="text-center" scope="col">User ID</th>
              <th scope="col">Username</th>
              <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
              <tr class="table-secondary">
                <th scope="row" style="width: 10%" class="text-center">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td style="width: 15%">
                  <button class="btn btn-primary" type="button">Delete</button>
                </td>
              </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection