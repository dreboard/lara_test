@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$user->name}} Profile</div>
                @component('components.alert')
                    @slot('title') Heads Up @endslot
                        You are not allowed to access this resource!
                @endcomponent
                @if ($errors->user->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->user->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>On Team {{$user->groupable->name}}</p>
                            <p>Roles
                            <ul>
                                @foreach($user->roles as $role)
                                    <li>{{$role->name}}</li>
                                @endforeach
                            </ul>

                            </p>
                        </div>
                        <div class="col-sm-6">
                            @can('author', App\User::class)
                                <form method="post" action="/assign_role">
                                    <p>Assign a role:</p>

                                    @foreach($roles as $role)
                                        <div class="form-check">
                                            <input
                                                    class="form-check-input"
                                                    type="checkbox" value="{{$role->id}}"
                                                    name="role_id[]"
                                            {{$user->roles->contains($role->id) ? 'checked' : ''}}
                                            >
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    @endforeach

                                    <input type="hidden" value="{{$user->id}}" name="user_id"/>
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Assign/Remove</button>
                                    </div>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            @if($user->profile_img == 'none')
                                <img src="{{ asset('img/profile_img.png') }}" class="img-fluid" alt="Responsive image">
                            @else
                                <img src="{{ asset('storage/'.$user->id.'/profile_img.jpeg') }}" class="img-fluid" alt="Responsive image">
                            @endif
                            {{-- <img src="/storage/{{$user->id}}/profile_img.jpeg" class="img-fluid" alt="Responsive image">--}}
                        </div>
                        <div class="col-sm-6">
                            @can('create', auth()->user())
                                <form method="post" action="{{ route('user.update', $user) }}" enctype="multipart/form-data">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <input type="hidden" value="{{$user->id}}" name="user_id"/>
                                    <div class="form-group">
                                        <label class="col-md-4">Name</label>
                                        <input type="text" class="form-control" name="name"
                                               value="{{request()->old('name', optional($user)->name)}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4">email</label>
                                        <input type="text" class="form-control" name="email"
                                               value="{{old('email', optional($user)->email)}}"/>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="profile_img">
                                        <label class="custom-file-label" for="customFile">Profile</label>
                                    </div>
                                    @can('updateUser', App\User::class)
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                        </div>
                                    @endcan

                                </form>
                            @endcan
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
