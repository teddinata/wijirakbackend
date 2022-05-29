<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use softDeletes;

    protected $fillable = [
        'users_id', 'products_id', 'transactions_id', 'code'
     ];

     protected $hidden = [

     ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'products_id', 'id');
    // }

     public function transaction()
     {
         return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
     }


}
