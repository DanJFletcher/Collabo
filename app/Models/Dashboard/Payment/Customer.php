<?php

namespace App\Models\Dashboard\Payment;


use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
      public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
