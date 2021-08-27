<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisProduk;
use Illuminate\Support\Facades\Validator;

class JenisProdukController extends Controller
{
    public function get_jenis_produk(){
        $jenis = JenisProduk::all();
        $res['status']=true;
        $res['message']='Sukses';
        $res['payload']=$jenis;
        return response($res);
    }

    public function update(Request $request){

        $id = $request->id;
        $nama=$request->nama;
        $keterangan=$request->keterangan;

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|unique:jenis_produk,nama,'.$id
        ]);

        if ($validator->fails()) {
            $res['status']=false;
            $res['message']='Tidak valid';
            $res['payload']=$validator->messages()->all();
        }else{
            $jenis = JenisProduk::find($id);
            if ($jenis == null){
                $res['status']=false;
                $res['message']='Data tidak ditemukan';
                $res['payload']=null;
            }else{

                $jenis->nama = $nama;
                $jenis->keterangan = $keterangan;
                $jenis->save();

                $res['status']=true;
                $res['message']='Sukses';
                $res['payload']=$jenis;
            }
        }

        return response($res);
    }

    public function add_jenis_produk(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|unique:jenis_produk,nama'
        ]);

        if ($validator->fails()) {
            $res['status']=false;
            $res['message']='Gagal';
            $res['payload']=$validator->messages()->all();

        }else{
            $data =  new JenisProduk();
            $data->nama = $request->nama;
            $data->keterangan = $request->keterangan;
            $data->save();
            $res['status']=true;
            $res['message']='Sukses';
            $res['payload']=$data;
        }

        return response($res);
    }

    public function detail(Request $request){
        $id=$request->id;
        $jenis = JenisProduk::find($id);

        if ($jenis == null){
            $res['status']=false;
            $res['message']='Data tidak ditemukan';
            $res['payload']=null;
        }else{
            $res['status']=true;
            $res['message']='Data ditemukan';
            $res['payload']=$jenis;
        }

        return response($res);
    }

    public function delete(Request $request){
        $id=$request->id;
        $jenis = JenisProduk::where('id','=',$id)->first();

        if ($jenis == null){
            $res['status']=false;
            $res['message']=$id;
            $res['payload']='Data tidak ditemukan';
        }else{
            $jenis->delete();
            $res['status']=true;
            $res['message']='Sukses';
            $res['payload']=$jenis;
        }
        return response($res);
    }

}
