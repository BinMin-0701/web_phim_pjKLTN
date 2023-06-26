<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pre extends Model
{
    use HasFactory;
    protected $table = 'pay_pre';
    protected $filltable = [
      'user_id', 'total', 'date'
    ];
    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
