<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'nisn_id'];

    public function phone():HasMany{
        return $this->hasMany(Phone::class);
    }

    public function nisn():BelongsTo{
        return $this->belongsTo(Nisn::class);
    }
}
