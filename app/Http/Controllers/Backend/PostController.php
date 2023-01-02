<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        $id_user = Auth::user()->id;
        $posts = Post::where('user_id', $id_user)->get();
        if (Auth::user()->is_admin == 1) {
            $posts = Post::all();
        } elseif (Auth::user()->is_admin == 0) {
            $id_user = Auth::user()->id;
            $posts = Post::where('user_id', $id_user)->get();
        } else {
            return view('error-access-user');
        }

        return view('backend.post.index' ,compact('posts'));
    }

    public function create()
    {
        return view('backend.post.create');
    }

    public function create_process(Request $request)
    {
        request()->validate([
            'title'         => 'required',
            'slug'         => 'required',
            'image'         => 'required|max:2048|mimes:jpg,jpeg,png',
            'description'   => 'required'
        ]);

        $image = time() . '.' . $request->image->extension();
        $request->image->move(public_path('post'), $image);

        Post::create([
            'title'         => $request->title,
            'slug'         => $request->slug,
            'image'         => $image,
            'description'   => $request->description
        ]);

        return redirect()->route('backend.manage.post')->with('success', 'Item Created Successfully');
    }

    public function show($id)
    {
        if ($id == null) {
            return redirect()->route('backend.manage.portfolio')->with('error', 'The ID is empty!');
        } else {
            $posts = Post::find($id);

            if ($posts) {
                return view('backend.post.show', compact('posts'));
            } else {
                return redirect()->route('backend.manage.post')->with('error', "The #ID {$id} not found in Database!");
            }
        }
    }

    public function edit($id)
    {
        if ($id == null) {
            return redirect()->route('backend.manage.post')->with('error', 'The ID is empty!');
        } else {
            $posts = Post::find($id);

            if ($posts) {
                return view('backend.post.edit', compact('posts'));
            } else {
                return redirect()->route('backend.manage.post')->with('error', "The #ID {$id} not found in Database!");
            }
        }
    }

    public function edit_process(Request $request)
    {
        request()->validate([
            'title'         => 'required',
            'slug'         => 'required',
            'image'         => 'required|max:2048|mimes:jpg,jpeg,png',
            'description'   => 'required'
        ]);

        $posts = Post::find($request->id);

        if (public_path('post/'. $posts->image))
            unlink(public_path('post/'.$posts->image));

        $image = time() . '.' . $request->image->extension();
        $request->image->move(public_path('post'), $image);


        Post::where('id', $request->id)
            ->update(([
                'title'         => $request->title,
                'slug'         => $request->slug,
                'image'         => $image,
                'description'   => $request->description
            ]));

        return redirect()->route('backend.manage.post')->with('success', 'Item Edited Successfully');

    }

    public function destroy($id)
    {
        $posts = Post::find($id);

        if (public_path('post/'. $posts->image))
            unlink(public_path('post/'.$posts->image));

        $posts->delete();

        return redirect()->route('backend.manage.post')->with('success', 'Item Deleted Successfully');
    }
}
