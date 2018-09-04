<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BirthdayExchangeRate extends Model
{
    protected $fillable = [
        'birthday',
        'currency_code',
        'exchange_rate'
    ];
}
