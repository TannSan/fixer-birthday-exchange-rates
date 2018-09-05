<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BirthdayExchangeRate extends Model
{
    protected $fillable = [
        'birthday',
        'search_count',
        'exchange_rate'
    ];
}
