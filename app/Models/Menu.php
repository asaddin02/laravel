<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    // protected untuk nama tabel yang akan diolah di database
    protected $table = 'menus';
    // protected untuk melindungi field yang tidak boleh diisi
    protected $guarded = [''];

    // fungsi untuk merelasikan tabel menu dengan kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
