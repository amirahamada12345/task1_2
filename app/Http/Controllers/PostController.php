<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest ;
use App\Http\Requests\UpdatePostRequest;
class PostController extends Controller
{
    public function index()
    {
        // $allPosts = Post::simplePaginate(2);
        $allPosts = Post::with('user')->paginate(4);
        // $books = Book::with('author')->get();
        // // $allPosts = Post::where('title','Test')->get();
        // $allPosts = Post::all(); //to retrieve all records

        return view('posts.index', [
            'allPosts' => $allPosts
        ]);
    }

    public function create()
    {
        $users = User::all();

        return view('posts.create',[
            'users' => $users
        ]);
    }

    public function store(StorePostRequest $request )
    {
        // $data = request()->all();
        $data = $request->all();
        // Post::create($data);
        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
            // will be ignored cause they aren't in fillable
            // 'un_known_column' => 'ajshdahsouid',
            // 'id' => 70,
        ]);// insert into (title,descripotion) values ('asdasd')

        // dd('test'); any logic after dd won't be executed
        //the logic to store post in the db
        return redirect()->route('posts.index');
    }

    // public function show($postId)
    // {
    //     //query in db select * from posts where id = $postId
    //     return $postId;
    // }

//************newcode******************* */


public function show($id)
{
    //query in db select * from posts where id = $postId
    // return $postId;
    $post = Post::where('id', '=', $id)->get()->first();
    // $post=Post::where('id', $id)->get()[0];
    // dd($post);
    return view('posts.show',['post'=>$post]);

}


public function edit($id)

{
    $post=Post::where('id', $id)->get()->first();
    //query in db select * from posts where id = $postId
    $users=User::all();
    return view('posts.edit',['post'=>$post,'users'=>$users]);
}




public function update($postId,UpdatePostRequest $request )
{
    $data = $request->only ( 'title','description','post_creator');
// $data = request()->all();

// query in db update table set ()=() where id = $postId
if(isset ( $data )){

$user=User::where('id', $data['post_creator'])->get()->first();

if(isset($user)){
    Post :: where('id', $postId)-> update([

        'title' => $data['title'],
        
        'description' => $data['description'],
        
        'user_id' => $data['post_creator'],
        
        ]);

}

}else{
    $data=post::where('id', $postId)->get()->first();

}


// dd($data);
// return redirect()->route('posts.show',$post);
return redirect()->route('posts.show',$postId);
}

//************************ */
// public function update(StorePostRequest $request,$id)
// {
//     $data=$request->all();

//    $post= Post::where('id',$id)->update(['title'=>$data['title'],
//     'description'=>$data['description'],
//     'user_id'=>$data['post_creator'],

    
// ]);
//     //query in db select * from posts where id = $postId
//     return redirect()->route('posts.show', $post);
// }



public function destroy($id){
    $post= Post::where('id',$id)->delete();
return redirect()->route('posts.index');

}







}
