<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use  App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
class postController extends Controller
{
   public function index(){

$allposts=post::paginate(); 


    // return $allposts;
    return  PostResource :: collection ($allposts);
   }

   public function show($postId){

    $post=post::find($postId); 
    
    
//         return [
// 'id'=> $post->id,
// 'title'=>$post->title,
// 'description'=>$post->description,
// 'user_name'=>$post->user->name,
//         ];
return new PostResource($post);

       }
    


    public function store(StorePostRequest $request)
    {
        // $data = request()->all();
        $data = $request->all();
      
        $post=Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
           
        ]);

       
        // return [
        //     'id'=> $post->id,
        //     'title'=>$post->title,
        //     'description'=>$post->description,
        //     'user_name'=>$post->user->name,
        //             ];
        return new PostResource($post);
    }

    
}
