<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxas extends Model
{
    protected $fillable = [
        'id', 'credito','creditoavista', 'debito'
    ];
}
