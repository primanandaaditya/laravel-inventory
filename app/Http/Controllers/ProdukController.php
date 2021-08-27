<?php

namespace App\Http\Controllers;

use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    public function all(){
        $produk = ProdukModel::all();
        $res['status']=true;
        $res['message']='Sukses';
        $res['payload']=$produk;
        return response($res);
    }

    public function detail(Request $request){
        $id = $request->id;
        $p = ProdukModel::find($id);

        if ($p == null){
            $res['status']=false;
            $res['message']='Data tidak ditemukan';
            $res['payload']=null;
        }else{
            $res['status']=true;
            $res['message']='Data ditemukan';
            $res['payload']=$p;
        }

        return response($res);
    }

    public function add(Request $request){

        $input = $request->all();

        if ($request->hasFile('gambar')){
            $input['gambar'] = $this->uploadFoto($request);
        }else{
            $input['gambar'] = "noimage.png";
        }

        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|unique:produk,nama',
            'id_jenis'      => 'required',
            'id_satuan'     => 'required',
            'hbeli'         => 'required'
        ]);

        if ($validator->fails()) {
            $res['status']      =false;
            $res['message']     ='Gagal';
            $res['payload']     =$validator->messages()->all();

        }else{
            $data =  new ProdukModel();
            $data->nama         = $request->nama;
            $data->id_jenis     = $request->id_jenis;
            $data->id_satuan    = $request->id_satuan;
            $data->hbeli        = $request->hbeli;
            $data->gambar       = $input['gambar'];
            $data->save();
            $res['status']      =true;
            $res['message']     ='Sukses';
            $res['payload']     =$data;
        }

        return response($res);
    }

    public function delete(Request $request){
        $id = $request->id;
        $produk = ProdukModel::where('id',$id)->first();

        if ($produk==null){
            $res['status']=false;
            $res['message']=$id;
            $res['payload']='Data tidak ditemukan';
        }else{
            if ($produk->gambar != '' || $produk->gambar != null){
                if (file_exists( public_path('foto/'. $produk->gambar))){
                    Storage::delete(public_path('foto/'.$produk->gambar));
                    unlink(public_path( 'foto/'.$produk->gambar));
                }
            }
            $produk->delete();
            $res['status']=true;
            $res['message']='Sukses';
            $res['payload']=$produk;
        }
        return response($res);
    }

    public function edit(Request $request){

        $id = $request->id;
        $produk = ProdukModel::where('id',$id)->first();

        if ($produk==null){
            $res['status']=false;
            $res['message']='Data tidak ditemukan';
            $res['payload']=null;
        }else{

            $input = $request->all();

            if ($request->hasFile('gambar')){
                if ($produk->gambar != '' || $produk->gambar != null){
                    if (file_exists( public_path('foto/'.$produk->gambar))){
                        Storage::delete(public_path('foto/'.$produk->gambar));
                        unlink(public_path( 'foto/'.$produk->gambar));
                    }
                }
                $input['gambar'] = $this->uploadFoto($request);
            }else{
                $input['gambar'] = "";
            }

            $validator = Validator::make($request->all(), [
                'nama'          => 'required|string|unique:produk,nama,'.$id,
                'id_jenis'      => 'required',
                'id_satuan'     => 'required',
                'hbeli'         => 'required'
            ]);

            if ($validator->fails()) {
                $res['status']      =false;
                $res['message']     ='Gagal';
                $res['payload']     =$validator->messages()->all();
            }else{
                $produk->nama         = $request->nama;
                $produk->id_jenis     = $request->id_jenis;
                $produk->id_satuan    = $request->id_satuan;
                $produk->hbeli        = $request->hbeli;
                $produk->gambar       = $input['gambar'];
                $produk->save();

                $res['status']      =true;
                $res['message']     ='Sukses';
                $res['payload']     =$produk;
            }
        }
        return response($res);
    }

    private function uploadFoto(Request $request)
    {
        $foto = $request->file('gambar');
        $ext  = $foto->getClientOriginalExtension();

        if ($request->file('gambar')->isValid()) {
            $foto_name   = date('YmdHis'). ".$ext";
            $upload_path = 'foto';
            $request->file('gambar')->move($upload_path, $foto_name);
            return $foto_name;
        }
        return false;
    }

}
