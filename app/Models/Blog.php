<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id', 'featured_image', 'blog'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function image():HasMany{
        return $this->hasMany(Image::class);
    }
}
