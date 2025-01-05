<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_outlet',
        'jenis',
        'nama_paket',
        'harga'
    ];

    protected $table = 'paket';

    public function outlet(){
        return $this->belongsTo(Outlet::class, 'id_outlet', 'id');
    }

    
    public function detailTransaksi()
    {
        return $this->hasMany(Detail_Transaksi::class, 'id_paket','id');
    }
}
