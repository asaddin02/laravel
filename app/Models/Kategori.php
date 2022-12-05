<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    // protected untuk nama tabel yang akan diolah di database
    protected $table = 'kategoris';
    // protected untuk melindungi field yang tidak boleh diisi
    protected $guarded = [''];

    // fungsi untuk merelasikan tabel kategori dengan menu
    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
