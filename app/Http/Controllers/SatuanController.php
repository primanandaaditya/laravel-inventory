<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SatuanModel;

class SatuanController extends Controller
{
    public function all(){
        $satuan = SatuanModel::all();
        $res['status']=true;
        $res['message']='Sukses';
        $res['payload']=$satuan;
        return response($res);
    }
}
