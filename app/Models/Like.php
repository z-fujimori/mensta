<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'post_id',
        'like',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function pust(){
        return $this->belongsTo(Post::class);
    }
}
