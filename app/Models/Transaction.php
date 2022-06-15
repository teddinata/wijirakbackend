<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use softDeletes;

    protected $fillable = [
        'users_id', 'total_price', 'status', 'code'
     ];

     protected $hidden = [

     ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id');
    }
}
