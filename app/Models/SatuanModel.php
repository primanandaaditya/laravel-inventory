<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanModel extends Model
{
    use HasFactory;
    protected $table='satuan';
    public $primaryKey='id';
    public function produk(){
        return $this->hasMany('App\Models\ProdukModel','id_satuan');
    }
}
