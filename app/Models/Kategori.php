<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'kategori_buku')->as('buku');
    }

    public function ebooks()
    {
        return $this->belongsToMany(Ebook::class, 'kategori_ebook')->as('ebook');
    }
}
