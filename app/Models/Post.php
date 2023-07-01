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
        return $this->with(['user','images'])->orderBy('updated_at', 'DESC')->get();
    }
    
    public function user(){
        return $this->belongsTo(User::class);    
    }
        
}

