@extends('layouts.admin')
@section('pageTitle', 'index')
@section('content')

<div class="container">
    <div class="row g-4">

        {{-- filter form --}}
        <form action="" method="GET" class="row mt-5 d-flex align-items-center">

            <div class="col">
                <label for="filter_title" class="form-label">{{__('Filter Title')}}</label>
                <input type="text" class="form-control" id="filter_title" name="filter_title" value="{{$request->filter_title}}">
            </div>

            {{-- FILTRO ALL USERS --}}
            <div class="col ">
                <select name="users" id="users">
                    <option value="">Select Users</option>
                    @foreach ($user as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            {{-- FILTER CATEGORIES --}}
            <div class="col">
                <select name="category" id="category">
                    <option value="">Select Category</option>
                    @foreach ($categories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>

            </div>

            <div class="col">
                <button class="btn btn-primary">Submit filter</button>
            </div>
        </form>

        @foreach ($element as $item)
            <div class="col-4">
                <div class="card h-100" style="width: 22rem;">
                    <div class="card-body">
                        <h2 class="card-title">Title: {{$item->title}}</h2>
                        <h5 class="card-title">Author: {{$item->user->name}}</h5>
                        <a href="{{route('admin.posts.show', $item->slug)}}" class="btn btn-primary px-3 me-2">Info</a>
                        
                        @if(Auth::user()->id == $item->user_id)
                            <a href="{{route('admin.posts.edit', $item->slug)}}" class="btn btn-primary px-3 me-2">Edit</a>
                            <form class="d-inline" action="{{ route('admin.posts.destroy', $item->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                            </form>
                        @endIf
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{$element->links()}}
</div>

@endsection