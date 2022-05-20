@extends('layouts.admin')
@section('pageTitle', 'index')
@section('content')

<div class="container">
    <div class="row g-4">
        @foreach ($element as $item)
        <div class="col-4">
            <div class="card h-100" style="width: 22rem;">
                <div class="card-body">
                    <h2 class="card-title">Title: {{$item->title}}</h2>
                    <h5 class="card-title">Slug: {{$item->slug}}</h5>
                    <a href="{{route('admin.posts.show', $item->slug)}}" class="btn btn-primary px-3 me-2">Info</a>
                    <a href="{{route('admin.posts.edit', $item->slug)}}" class="btn btn-primary px-3 me-2">Edit</a>
                    <form class="d-inline" action="{{ route('admin.posts.destroy', $item->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{$element->links()}}
</div>

@endsection