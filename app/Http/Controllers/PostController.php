<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post ;
use App\Category ;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts=Post::where(function ($query) use ($request){
            if($request->has('search')){
                $query->whereHas('category',function ($category) use($request){
                    $category->where('name','like','%'.$request->search.'%');
                });
                $query->orWhere(function ($query) use($request){
                    $query->where('title','like','%'.$request->search.'%')
                          ->orWhere('content','like','%'.$request->search.'%');
                });
                
            }
        })->latest()->paginate();
    
    
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view ('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:150',
            'content' => 'required|max:3500',
            'category_id' => 'required',
            'image' =>'sometimes|file|image|max:5000'
        ]);
       $post= Post::create($data);
       
       $this ->storeImage($post);

        flash()->success('A New Post ( '. $request->title.' ) has been added successfully ');
        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return view ('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $id= $post->category->id;
        $categories = Category::where('id','!=',$id )->get();
      return view('posts.edit',compact('categories','post')) ;
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
        $post = Post::findOrFail($id);
        $post ->update($request->all());

        $this ->storeImage($post);

        flash()->success('edited successfully');
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =Post::findOrFail($id);
        $post ->delete();
        flash()->success($post->title.' Post is deleted Successfully');
        return redirect(route('post.index'));

    }
  
    private function storeImage($post){
        if(request()->has('image')){
            $post->update([
                 'image' => request()->image->store('uploads','public'),
            ]);
        }
     /*public function search (Request $request){
        $request ->validate([
            'query'=> 'required|min:3',
        ]);
        $query =$request->input('query');
        $posts = Post::where('title','like',"%$query%")
                      ->orWhere('title','like',"%$query%") ->get();
        return view('posts.search',compact('posts'));
    }

     */
}
}