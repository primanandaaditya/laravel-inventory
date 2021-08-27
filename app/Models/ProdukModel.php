<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisProduk;
use App\Models\SatuanModel;

class ProdukModel extends Model
{
    use HasFactory;
    protected $table = 'produk';
    public $primaryKey = 'id';
    protected $appends = ['jenis','satu'];


    public function getJenisAttribute(){
        return $this->jenisproduk->nama;
    }

    public function getSatuAttribute(){
        return $this->satuan->nama;
    }


    public function jenisproduk(){
        return $this->belongsTo('App\Models\JenisProduk','id_jenis');
    }

    public function satuan(){
        return $this->belongsTo('App\Models\SatuanModel','id_satuan');
    }
}
