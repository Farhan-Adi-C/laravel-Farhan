<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nisn extends Model
{
    use HasFactory;
    protected $table = 'nisns';
    protected $fillable = ['nisn'];

    public function siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, 'nisn_id');
    }
}
