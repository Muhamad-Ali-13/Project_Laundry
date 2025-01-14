<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_outlet',
        'kode_invoice',
        'id_member',
        'tanggal',
        'batas_waktu',
        'tgl_bayar',
        'biaya_tambahan',
        'diskon',
        'pajak',
        'status',
        'dibayar',
        'id_user',
        'total_bayar',
        
    ];

    public static function createCode()
    {
        $latestCode = self::orderBy('kode_invoice', 'desc')->value('kode_invoice');
        $latestCodeNumber = intval(substr($latestCode, 2));
        $nextCodeNumber = $latestCodeNumber ? $latestCodeNumber + 1 : 1;
        $formattedCodeNumber = sprintf("%05d", $nextCodeNumber);
        return 'I' . $formattedCodeNumber;

        // $latestCode = self::orderBy('id_transaksi', 'desc')->value('id_transaksi');
        // $latestCodeNumber = intval(substr($latestCode, 2));
        // $nextCodeNumber = $latestCodeNumber ? $latestCodeNumber + 1 : 1;
        // $formattedCodeNumber = sprintf("%05d", $nextCodeNumber);
        // return 'I' . $formattedCodeNumber;

    
    }

    protected $table = 'transaksi';

    public function outlet(){
        return $this->belongsTo(Outlet::class, 'id_outlet', 'id');
    }
    public function member(){
        return $this->belongsTo(Outlet::class, 'id_member', 'id');
    }
    public function user(){
        return $this->belongsTo(Outlet::class, 'id_user', 'id');
    }
    public function detailTransaksi()
    {
        return $this->hasMany(Detail_Transaksi::class, 'id_transaksi', 'kode_invoice');
    }
    
    
}
