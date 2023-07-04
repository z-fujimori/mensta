<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class restaurant extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'name',
        'api_id',
        'lat',
        'lng',
    ];
    
    
    public function posts(){
        return $this->hasMany(Post::class);
    }
    
}
