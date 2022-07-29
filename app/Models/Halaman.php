<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halaman extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ebook()
    {
        return $this->belongsTo(Ebook::class);
    }
}
