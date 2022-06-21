<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    // Initialize
    protected $fillable = [
        'kode_produksi', 'nama_supplier', 'alamat_supplier', 'target_jumlah', 'keterangan',
    ];
}
