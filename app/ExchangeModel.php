<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeModel extends Model
{
    //
    protected $table = "exchanges";
        
    protected $fillable = [
        'userId',
        'currencyFrom',
        'currencyTo',
        'amountSell',
        'amountBuy',
        'rate',
        'timePlaced',
        'originatingCountry',
    ];


    protected $casts = [
        'timePlaced' => 'date:d-M-y H:i:s',
    ];

}
