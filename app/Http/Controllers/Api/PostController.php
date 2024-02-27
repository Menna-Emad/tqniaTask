<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;



class PostController extends Controller
{
    public function index()
    {
        
        $posts= Post::all();
        
        return response()->json(compact('posts'));
        
    }
   

    public function create()
    {
       
        return response()->json();

    }
    

    public function edit($id)//gayely route parameter ely hwa el id f lazm asr2belo k parameter
    {
       
      
       $posts=Post::findOrFail($id);
      
       return response()->json();
       //bs lazm a3ml validate 3la el id abl m a3ml find f hstkhdm findorfail hena laravel b validate lwahdo
    }
    public function store(StorePostRequest $request)
    {
        $photoName=$this->uploadPhoto($request->cover_image,'posts');
        //insert
        $data=$request->except('cover_image');
        $data['cover_image']=$photoName;
        //create product bl eloquonte
        $post=Post::create($data);
        return response()->json(['success'=> true,'message'=>"post created successfully"]);   
    }

    public function update(UpdatePostRequest $request,$id)
    {
         //nkhzn image in db
         $data=$request->except('cover_image');
         if($request->has('cover_image')){
            //hms7 el adema el awl
            $oldphotoName=Post::find($id)->cover_image;
            $this->deletePhoto(public_path('img/posts/'.$oldphotoName));
           
            $photoName=$this->uploadPhoto($request->cover_image,'posts');
            $data['cover_image']=$photoName;
         }
        
         Post::where('id',$id)->update($data);
         return response()->json(['success'=> true,'message'=>"post updated successfully"]);
    }

        public function destroy($id)
        {
               //delete photo
                $oldphotoName=Post::find($id)->cover_image;
               
                $this->deletePhoto(public_path('img/posts/'.$oldphotoName));
               
                Post::where('id',$id)->delete();
                return response()->json(['success'=> true,'message'=>"post deleted successfully"]);
    
        }
}
