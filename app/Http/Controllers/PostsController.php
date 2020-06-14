<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware(['verifyCategoriesCount'])->only(['create', 'store']);
    }
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', compact(['posts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        // dd($request->category_id);
        // Image Upload and stores the name of the image
        $image = $request->file('image')->store('posts');
        // run command: php artisan storange:link
        //Create Post
        Post::create([
            'title' =>$request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category_id
        ]);
        // session storage
        session()->flash('success', 'Post Created Successfully');
        //redirect
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'excerpt', 'content', 'published_at', 'category_id']);
        if($request->hasFile('image')) {
            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }
        $post->update($data);
        session('success', 'Post updated successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->deleteImage();
        $post->forceDelete();
        session()->flash('success', 'Post successfully deleted');
        return redirect(route('posts.index'));
    }

    public function trashed() {
        // dd("hi");
        $trashed = Post::onlyTrashed()->paginate(10);
        return view('posts.trashed')->with('posts', $trashed);
    }
    public function trash(Post $post) {
        $post->delete();
        session()->flash('success', 'Post trashed Successfully');
        return redirect(route('posts.index'));

    }
    public function restore($id) {
        $trashedPost = Post::onlyTrashed()->findOrFail($id);
        $trashedPost->restore();
        session()->flash('success', 'Post successfully restored');
        return redirect(route('posts.index'));
    }
}
