<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payaments extends Model
{

    const DEBITO  = '1.5';
    const CREDITO = '5.0';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nome', 'tipo','valor','parcelas','ref'
    ];
}
