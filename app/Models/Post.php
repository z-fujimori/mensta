<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'ramen_name',
        'price',
        'text',
        'user_id',
        'restaurant_id',
    ];
    
    public function images(){
        return $this->hasMany(Image::class);
    }
    
    public function getByat()
    {
        // updated_atで降順に並べた,eagerloadをするwith(['user','images'])
        return $this->withCount('likes')->with(['user','images'])->orderBy('updated_at', 'DESC')->get();
    }
    
    public function getShow($id){
        return $this->withCount('likes')->where("id",$id)->get();
    }
    
    public function getUser($id){
        return $this->withCount('likes')->where("user_id",$id)->orderBy('updated_at', 'DESC')->get();
    }
    
    public function user(){
        return $this->belongsTo(User::class);    
    }
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
        
}

