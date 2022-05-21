@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('admin.posts.create')}}" class="btn btn-primary" >Create Post</a>
                    <a href="{{route('admin.posts.myindex')}}" class="btn btn-primary" >My Posts</a>
                    <a href="{{route('admin.posts.index')}}" class="btn btn-primary" >All posts</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
