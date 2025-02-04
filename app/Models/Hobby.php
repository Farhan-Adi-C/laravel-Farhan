<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $fillable = ['hobby'];
    use HasFactory;
    
    public function siswa(){
        return $this->belongsToMany(Siswa::class, 'siswa_hobby');
    }
}
