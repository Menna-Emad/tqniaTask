<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    public function index()
    {
        //get all products
        //el products rag3a mn db de array of objects rag3a mn db shyla el products
        //el products de mehtaga tt3erd f hat pass ll view f ha7wlha l array b compact
        // $posts= DB::table('posts')
        //     ->select('id','user_id', 'title','body','cover_image','tags','created_at')
        //     ->get();//get de zy fetch all btgeb el db fe array indexed shayla kza object
        //pass these data to products view
        $tags=Tag::all();
        $tags = Tag::where('user_id', Auth::user()->id)->get();
        $tags = Tag::where('post_id', Auth::post()->id)->get(); 
        return view('dashboard')->with('tags',$tags);
    }

    public function create()
    {
        
        return view('tags.create');
    }

    public function store(StorePostRequest $request)
    {
        
        
        // DB::table('posts')->insert($data);
        $data=$request->all();
        Tag::create($data);
        //redirect
        if($request->page=='back'){
            return redirect()->back()->with('success','operation success');

        }else{
            return redirect()->route('dashboard');
        }
    }

    public function edit($id)
    {
        $tags=DB::table('tags')->where('id',$id)->first();
        $tags = Tag::where('user_id', Auth::user()->id)->get(); 
        $tags = Tag::where('post_id', Auth::post()->id)->get(); 
        return view('tags.edit',compact('tag'));
    }

    public function update(UpdateTagRequest $request,$id)
    {
        
        $data=$request->all();
         //update product into db
         DB::table('tags')->where('id',$id)->update($data);
    
         //redirect
         if($request->page){
            return redirect()->route('dashboard')->with('success','operation success');

        }
    }

    public function destroy($id)
    {
           
            DB::table('tags')->where('id',$id)->delete();
            return redirect()->route('dashboard')->with('success','operation success');

    }
   
}
