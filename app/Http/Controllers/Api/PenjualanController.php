<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Http\Resources\APIResource;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::get();

        return new APIResource(true, 'List Penjualan', $penjualan);
    }

    public function store( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produk_id' => 'required',
            'tanggalPenjualan' => 'required',
            'namaProduk' => 'required',
            'jumlahBarang' => 'required',
            'totalHarga' => 'required',
        ]);

        if ($validator->fails()) {
            return response() -> json($validator->errors(), 422);
        }

        $penjualan = Penjualan::create([
            'produk_id' => $request->produk_id,
            'tanggalPenjualan' => $request->tanggalPenjualan,
            'namaProduk' => $request->namaProduk,
            'jumlahBarang' => $request->jumlahBarang,
            'totalHarga' => $request->totalHarga,
        ]);

        return new APIResource(true, 'Data Penjualan berhasil ditambahkan!', $penjualan);
    }

    public function show(Penjualan $penjualan)
    {
        return new APIResource(true, 'Data Penjualan ditemukan!', $penjualan);
    }

    public function update(Request $request, Penjualan $penjualan
    )
    {
        $validator = Validator::make($request->all(), [
            'produk_id' => 'required',
            'tanggalPenjualan' => 'required',
            'namaProduk' => 'required',
            'jumlahBarang' => 'required',
            'totalHarga' => 'required',
        ]);

        if ($validator->fails()) {
            return response() -> json($validator->errors(), 422);
        }

        $penjualan -> update([
            'produk_id' => $request->produk_id,
            'tanggalPenjualan' => $request->tanggalPenjualan,
            'namaProduk' => $request->namaProduk,
            'jumlahBarang' => $request->jumlahBarang,
            'totalHarga' => $request->totalHarga,
        ]);

        return new APIResource(true, 'Data Penjualan berhasil diubah!', $penjualan);
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return new APIResource(true, 'Data Penjualan berhasil dihapus!', $penjualan);
    }
}
