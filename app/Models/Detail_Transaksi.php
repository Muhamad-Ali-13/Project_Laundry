<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tansaksi',
        'id_paket',
        'qty',
        'keterangan'
    ];

    protected $table = 'detail_transaksi';


    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }

    public function detail()
    {
        return $this->hasMany(Detail_Transaksi::class, 'id_transaksi');
    }
}
