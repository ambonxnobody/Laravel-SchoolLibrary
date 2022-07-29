<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function halamen()
    {
        return $this->hasMany(Halaman::class);
    }

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_ebook')->as('kategori');
    }
}
