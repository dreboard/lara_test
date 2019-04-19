@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>New Post</h1></div>

                    <form method="post" action="{{ url('/post') }}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-md-4">Title</label>
                            <input type="text" class="form-control" name="title"/>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4">Body</label>
                            <textarea class="form-control" name="body"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection