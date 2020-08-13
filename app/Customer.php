<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'date_of_birth', 'is_active'
    ];

    public $timestamps = false;

    protected $dates = [
        'date_of_birth',
    ];
}
