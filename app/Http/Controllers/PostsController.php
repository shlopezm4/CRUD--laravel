<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PostsController extends Controller
{
    private $path = 'post';

    public function __construct()
    {
        // $this->middleware('auth')->only('store');
    }
    
    public function index()
    {
        $posts = Post::search(Input::get('search'))->orderBy('id', 'desc')->paginate(6);
        $active_users = User::active()->get();
        return view($this->path.'.posts', ['posts' => $posts, 'active_users' => $active_users]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view($this->path.'.index', ['post' => $post]);
    }
  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path.".create");
    }
    public function store(PostRequest $request)
    {
        $this->authorize('create', Post::class);
        Post::create([
        'title' => $request->title,
        'body' => $request->body,
        'user_id' => Auth::id()
        ]);
        return back()->with('success', $request->title." fue agregado");
        ;
    }

    public function edit(Request $request)
    {
        $post = Post::findOrFail($request->id);
        $this->authorize('update', $post);
        return view('post_edit', ['post' => $post]);
    }

    public function update(PostRequest $request)
    {
        $post = Post::findOrFail($request->id);
        $this->authorize('update', $post);
        $post->update([
        'title' => $request->title,
        'body' => $request->body
        ]);
        return redirect('posts');
    }

    public function destroy(Request $request)
    {

        $post = Post::findOrFail($request->id);
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('posts');
    }
}
