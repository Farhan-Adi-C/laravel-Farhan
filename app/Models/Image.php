<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = ['image'];

    public function blog():BelongsTo{
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
