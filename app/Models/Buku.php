<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function peminjamen()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_buku')->as('kategori');
    }
}
