<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function produksi()
    {
        return $this->belongsTo(Produksi::class);
    }

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }
}
