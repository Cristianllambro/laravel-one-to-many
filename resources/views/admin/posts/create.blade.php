@extends('layouts.admin')
@section('pageTitle', 'Create New Post')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form method="POST" action="{{ route('admin.posts.store')}}">
                @csrf

                {{-- TITLE --}}
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3 pt-5">
                    <label for="title" class="form-label">{{__('Title')}}:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                </div>

                {{-- SELECT CATEGORY --}}
                <select name="category_id" id="category_id">
                    <option value="">Select Category</option>
                    @foreach ($allCategories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- SLUG --}}
                @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3 pt-3">
                    <label for="slug" class="form-label">{{__('Slug')}}:</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')}}">
                </div>
                {{-- Button create slug --}}
                <input class="btn btn-primary mb-3" type="button" value="Generate slug" id="btn-slugger">

                {{-- CONTENT --}}
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-floating">
                    <label for="description">{{ __('Content') }}</label>
                    <textarea class="form-control" placeholder="Description" id="description" name="description">{{old('description')}}</textarea>
                  </div>
              
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div> 
    </div>
</div>
  
@endsection