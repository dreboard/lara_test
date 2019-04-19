@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">All Users</div>
            @if ($errors->user->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->user->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div>
            @can('create', App\User::class)
                <form method="post" action="{{ url('user') }}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-md-4">Name</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">email</label>
                        <input type="text" class="form-control" name="email"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            @endcan
            <div class="card">

                    @if(count($users))
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Is Admin</th>
                                <th scope="col">Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row"></th>
                                    <td>
                                        @can('view', App\User::class)
                                        <a href="{{$user->path()}}"> {{ $user->name }}</a>
                                        @else
                                            {{ $user->name }}
                                        @endcan
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->isAdmin }}</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
