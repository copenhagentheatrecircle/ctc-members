<?php

namespace App\Http\Controllers;

use App\Post;
use App\Person;
use App\User;
use App\Posttype;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('member');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('posttype_id','<>',5)->orderBy('created_at','desc')->get();
        // return $posts;
        return view ('posts.index', Compact ('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posttypes = Posttype::where('is_bulletin_board',1)->where('write_admin_only',null)->get();
        return view ('posts.create', Compact('posttypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Post::create($request->all());
        return redirect ('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
      $post = Post::where('id',$post)->first();
      $posts = Post::where('posttype_id','<>',5)->with('comments')->orderBy('created_at','desc')->get();
      foreach ($posts as $item) {
          $id_array[] = $item->id;
      }
      $current = $post->id;
      $currentkey = array_search($current, $id_array);
      $currentrecord = $currentkey + 1;
      $count = count($id_array);
      if ($currentkey + 1 < $count) {
          $next = $id_array[$currentkey + 1];
      } else {
          $next = "";
      }
      if ($currentkey > 0) {
          $previous = $id_array[$currentkey - 1];
      } else {
          $previous = "";
      }

        return view ('posts.show', Compact('post','next','previous','count','currentrecord'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
