<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'transactions_id',
        'penerima',
        'foto',
        'bank_pengirim',
        'nama_pengirim',
        'rekening_pengirim',
        'tanggal_transfer',
        'total_transfer',
    ];

    protected $hidden = [

    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    public function detail()
    {
        return $this->belongsTo(TransactionDetail::class);
    }
}
