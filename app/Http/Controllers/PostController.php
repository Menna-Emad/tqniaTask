<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\UpdatePosttRequest;
class PostController extends Controller
{
    //4 methods (index,edit,create,destroy)
    use media;
    public function index()
    {
        //get all products
        //el products rag3a mn db de array of objects rag3a mn db shyla el products
        //el products de mehtaga tt3erd f hat pass ll view f ha7wlha l array b compact
        // $posts= DB::table('posts')
        //     ->select('id','user_id', 'title','body','cover_image','tags','created_at')
        //     ->get();//get de zy fetch all btgeb el db fe array indexed shayla kza object
        //pass these data to products view
        $posts=Post::all();
        $posts = Post::where('user_id', Auth::user()->id)->get(); 
        return view('dashboard')->with('posts',$posts);
    }

    public function create()
    {
        
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        
        //use trait ely 3mlnah
        $photoName=$this->uploadPhoto($request->cover_image,'posts');
        //insert
        $data=$request->except('_token','cover_image','page');
        $data['cover_image']=$photoName;
        // DB::table('posts')->insert($data);
        $data=$request->all();
        Post::create($data);
        //redirect
        if($request->page=='back'){
            return redirect()->back()->with('success','operation success');

        }else{
            return redirect()->route('dashboard');
        }
    }

    public function edit($id)
    {
        $posts=DB::table('posts')->where('id',$id)->first();
        $posts = Post::where('user_id', Auth::user()->id)->get(); 
        
        return view('posts.edit',compact('post'));
    }

    public function update(UpdatePostRequest $request,$id)
    {
        
         $data=$request->except('_token','cover_image','page');
         if($request->has('cover_image')){
            //hms7 el adema el awl
            $oldphotoName=DB::table('posts')->select('cover_image')->where('id',$id)->first()->cover_image;
            
            $this->deletePhoto(public_path('img/posts'.$oldphotoName));
            
            $photoName=$this->uploadPhoto($request->cover_image,'posts');
            $data['cover_image']=$photoName;
         }
         //update product into db
         DB::table('posts')->where('id',$id)->update($data);
    
         //redirect
         if($request->page){
            return redirect()->route('dashboard')->with('success','operation success');

        }
    }

    public function destroy($id)
    {
           //delete photo
            $oldphotoName=DB::table('posts')->select('cover_image')->where('id',$id)->first()->cover_image;
           
            $this->deletePhoto(public_path('img/posts/'.$oldphotoName));
            
            DB::table('posts')->where('id',$id)->delete();
            return redirect()->route('dashboard')->with('success','operation success');

    }
    public function pin(Post $post)
    {
        $post->update(['is_pinned' => true]);
        $posts = Post::query()
    ->orderbyRaw('is_pinned DESC, created_at DESC')
    ->get();
    return back();
    } 
}
