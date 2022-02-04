<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


use Sluggable;

function sluggable(): array

{

return [

'slug' => [

'source' => 'title'

// for cascade updating : change in config\slugger ==> OnUpdate = true

]

];

}

    //doesnot follow convention
    // public function testRelation()
    // {
    //     return $this->belongsTo(User::class,'post_creator');
    // }
}
