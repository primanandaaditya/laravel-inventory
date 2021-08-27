<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProdukModel;

class JenisProduk extends Model
{
    use HasFactory;
    protected $table='jenis_produk';
    public $primaryKey='id';
    public function produk(){
        return $this->hasMany('App\Models\ProdukModel','id_jenis');
    }
}
