<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class image extends Model
{
    use HasFactory;
    
    public function getId($id){
        return Image::where('post_id',$id);
    }
    
    protected $fillable = [
        'post_id',
        'link',
    ];
}
