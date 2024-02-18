<?php

namespace App\Http\Controllers\Apis;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;



class PostController extends Controller
{
    public function index()
    {
        
        $tags= Tag::all();
        
        return response()->json(compact('tags'));
        
    }
   

    public function create()
    {
       
        return response()->json();

    }
    

    public function edit($id)//gayely route parameter ely hwa el id f lazm asr2belo k parameter
    {
       
      
       $tags=Tag::findOrFail($id);
      
       return response()->json();
       //bs lazm a3ml validate 3la el id abl m a3ml find f hstkhdm findorfail hena laravel b validate lwahdo
    }
    public function store(StoreTagRequest $request)
    {
        $data=$request;
        //create product bl eloquonte
        $tag=Tag::create($data);
        return response()->json(['success'=> true,'message'=>"post created successfully"]);   
    }

    public function update(UpdateTagRequest $request,$id)
    {
         //nkhzn image in db
         $data=$request->all();
        
           
            
         Tag::where('id',$id)->update($data);
         return response()->json(['success'=> true,'message'=>"post updated successfully"]);
    }

        public function destroy($id)
        {
               
                Tag::where('id',$id)->delete();
                return response()->json(['success'=> true,'message'=>"post deleted successfully"]);
    
        }
}
