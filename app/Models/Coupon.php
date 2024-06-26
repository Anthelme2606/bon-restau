<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use carbon\Carbon;
class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'code',
        'price',
        'date'
    ];
    public function transactions(){
        return $this->hasMany(Transaction::class,'coupon_id','id');
    }
    public function status($transaction){
        if($transaction)
        {
            $date_bon=Carbon::parse($transaction->bon->date);
            $trans_date=Carbon::parse($transaction->created_at);
            if($date_bon->lt($trans_date)){
              return "Expire.";
            }
            else {
                return "Actif";
            }
     
        }
       
    }
    
}
