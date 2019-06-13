<?php

namespace App\Http\Controllers;
use App\Tag;
use App\Like;
use App\Post;
use Auth;
use Gate;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
       

    public function getIndex()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(2);
        return view('blog.index', ['posts' => $posts]);
    }

    public function getAdminIndex()
    {


        $posts = Post::orderBy('title','asc')->get();
        return view('admin.index', ['posts' => $posts]);
    }

    public function getPost($id)
    {
        $post = Post::where('id','=',$id)->with('likes')->first(); //find($id)
        return view('blog.post', ['post' => $post]);
    }

    public function getLikePost($id)
    {
        $post = Post::where('id','=',$id)->first(); //find($id)
        $like = new Like();
        $post->likes()->save($like);
        return redirect()->back();
    }

    public function getAdminCreate()
    {


        $tags=Tag::all();
        return view('admin.create',['tags'=>$tags]);
    }

    public function getAdminEdit($id)
    {


        $post = Post::find($id);
         $tags=Tag::all();
        return view('admin.edit', ['post' => $post, 'postId' => $id,'tags'=>$tags]);
    }

    public function postAdminCreate(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $user=Auth::user();

        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        $user->posts()->save($post);
        $post->tags()->attach($request->input('tags')===null ?[] :$request->input('tags'));
        return redirect()->route('admin.index')->with('info', 'Post created, Title is: ' . $request->input('title'));
    }

    public function postAdminUpdate(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = Post::find($request->input('id'));
        if(Gate::denies('update_post',$post)){
            return redirect()->back();
        }
        $post->title=$request->input('title');
        $post->content=$request->input('content');
        $post->save();
        // $post->tags()->detach();
        // $post->tags()->attach($request->input('tags')===null ?[] :$request->input('tags'));
        $post->tags()->sync($request->input('tags')===null ?[] :$request->input('tags'));
        return redirect()->route('admin.index')->with('info', 'Post Edited, new Title is: ' . $request->input('title'));
    }

    public function getAdminDelete($id){


        $post=Post::find($id);
        if(Gate::denies('update_post',$post)){
            return redirect()->back();
        }
        //hard delete
        $post->likes()->delete();
        $post->tags()->detach();
        $post->delete();
        //soft delete
        //$post->softDeletes();
        return redirect()->route('admin.index')->with('info', 'Post Deleted ');
    }
}
