<?php

namespace App\Http\Controllers\index;

use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$users = User::all()->toJson();
		return response($users, 200)->header('Access-Control-Allow-Origin', '*');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		$user = User::findOrFail($id)->toArray();
		$posts = Post::where('user_id', '=', $user['id'])->paginate(10)->toArray();
		foreach ($posts['data'] as &$eachPost) {
			$tag = Tag::find($eachPost['tag_id'])->toArray();
			$eachPost['md_content'] = mb_substr($eachPost['md_content'], 0, 200 ,'utf-8');
			$eachPost['tag'] = $tag;
		}
		$data = array();
		$data['userInfo'] = $user;
		$data['articles'] = $posts;
		return response(json_encode($data), 200)->header('Access-Control-Allow-Origin', '*');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
