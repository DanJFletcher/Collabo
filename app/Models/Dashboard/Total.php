<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Total extends Model
{
      public function event()
    {
        return $this->belongsTo(Event::class);

    }
}
