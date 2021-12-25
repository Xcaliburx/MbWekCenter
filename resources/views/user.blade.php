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

                <form method="POST" action="{{ url('/admin/user', $user->id ) }}">
                  @csrf
                  @method('DELETE')

                  <td style="width: 15%">
                    <button class="btn btn-primary" onclick="return confirm('Are you sure you want to delete?')" type="submit">Delete</button>
                  </td>
                </form>
              </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection