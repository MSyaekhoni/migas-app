<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Http\Resources\APIResource;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::get();

        return new APIResource(true, 'List Produk', $produk);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produksi_id' => 'required',
            'namaProduk' => 'required',
            'stokProduk' => 'required',
            'hargaJual' => 'required',
        ]);

        if ($validator->fails()) {
            return response() -> json($validator->errors(), 422);
        }

        $produk = Produk::create([
            'produksi_id' => $request->produksi_id,
            'namaProduk' => $request->namaProduk,
            'stokProduk' => $request->stokProduk,
            'hargaJual' => $request->hargaJual,
        ]);

        return new APIResource(true, 'Data Produk berhasil ditambahkan!', $produk);
    }

    public function show(Produk $produk)
    {
        return new APIResource(true, 'Data Produk ditemukan!', $produk);
    }

    public function update(Request $request, Produk $produk)
    {
        $validator = Validator::make($request->all(), [
            'produksi_id' => 'required',
            'namaProduk' => 'required',
            'stokProduk' => 'required',
            'hargaJual' => 'required',
        ]);

        if ($validator->fails()) {
            return response() -> json($validator->errors(), 422);
        }

        $produk -> update([
            'produksi_id' => $request->produksi_id,
            'namaProduk' => $request->namaProduk,
            'stokProduk' => $request->stokProduk,
            'hargaJual' => $request->hargaJual,
        ]);

        return new APIResource(true, 'Data Produk berhasil diubah!', $produk);
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return new APIResource(true, 'Data Produk berhasil dihapus!', $produk);
    }
}
