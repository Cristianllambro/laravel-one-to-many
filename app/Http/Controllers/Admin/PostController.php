<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Route;

class PostController extends Controller
{
    public function getValidator($item) {
        return [
            'title' => 'required|max:100',
            'description' => 'required',
            'category_id' =>'required|exists:App\Category,id',
            'slug' => ['required', Rule::unique('posts')->ignore($item), 'max:100'],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // filter user-title-category
        $element = Post::where('id', '>', 0);

        if($request->filter_title) {
            $element->where('title', 'LIKE', "%$request->filter_title%");
        }

        if($request->category) {
            $element->where('category_id', $request->category);
        }

        if($request->user) {
            $element->where('user_id', $request->user);
        }
        
        $element = $element->paginate(20);
        $categories = Category::all();
        $users = User::all();
        //$element = Post::paginate(25);

        return view('admin.posts.index', [
            'element' => $element,
            'categories' => $categories,
            'user' => $users,
            'request' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategories = Category::all();
        return view('admin.posts.create', compact('allCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->getValidator(null));

        //new post unito all'utente loggato con il suo id (aggiungere user_id nel fillable)
        $newPost  = $request->all() + ['user_id' => Auth::user()->id];
        $element = Post::create($newPost);
        return redirect()->route('admin.posts.show', $element->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        //controllo per le modifiche tramite url
        if(Auth::user()->id !== $post->user_id) {
            abort(403);
        }
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //controllo se non si ha lo stesso id
        if(Auth::user()->id !== $post->user_id) {
            abort(403);
        }

        $request->validate($this->getValidators($post));
        $post->update($request->all());
        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //controllo per il delete sempre per l'id
        if(Auth::user()->id !== $post->user_id) {
            abort(403);
        }

        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    public function myindex() {
        $element = Post::where('user_id', Auth::user()->id)->paginate(25);
        return view('admin.posts.index', compact('element'));
    }
}
