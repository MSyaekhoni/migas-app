<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produksi;
use App\Http\Resources\APIResource;
use Illuminate\Support\Facades\Validator;

class ProduksiController extends Controller
{
    public function index()
    {
        $produksi = Produksi::get();

        return new APIResource(true,'List Periode Produksi',$produksi);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggalProduksi' => 'required',
            'jumlahModal' => 'required',
            'hargaBarangMentah' => 'required',
            'biayaPekerja' => 'required',
            'biayaTransportasi' => 'required',
            'biayaLain' => 'required'
        ]);

        if ($validator->fails()) {
            return response() -> json($validator->errors(), 422);
        }

        $produksi = Produksi::create([
            'tanggalProduksi' => $request->tanggalProduksi,
            'jumlahModal' => $request->jumlahModal,
            'hargaBarangMentah' => $request->hargaBarangMentah,
            'biayaPekerja' => $request->biayaPekerja,
            'biayaTransportasi' => $request->biayaTransportasi,
            'biayaLain' => $request->biayaLain,
        ]);

        return new APIResource(true, 'Data Produksi berhasil ditambahkan!', $produksi);
    }

    public function show(Produksi $produksi)
    {
        return new APIResource(true, 'Data Produksi ditemukan!', $produksi);
    }

    public function update(Request $request, Produksi $produksi)
    {
        $validator = Validator::make($request->all(), [
            'tanggalProduksi' => 'required',
            'jumlahModal' => 'required',
            'hargaBarangMentah' => 'required',
            'biayaPekerja' => 'required',
            'biayaTransportasi' => 'required',
            'biayaLain' => 'required'
        ]);

        if ($validator->fails()) {
            return response() -> json($validator->errors(), 422);
        }

        $produksi->update([
            'tanggalProduksi' => $request->tanggalProduksi,
            'jumlahModal' => $request->jumlahModal,
            'hargaBarangMentah' => $request->hargaBarangMentah,
            'biayaPekerja' => $request->biayaPekerja,
            'biayaTransportasi' => $request->biayaTransportasi,
            'biayaLain' => $request->biayaLain,
        ]);

        return new APIResource(true, 'Data Produksi berhasil diubah!', $produksi);
    }

    public function destroy(Produksi $produksi)
    {
        $produksi->delete();

        return new APIResource(true, 'Data Produksi berhasil dihapus!', $produksi);
    }
}
