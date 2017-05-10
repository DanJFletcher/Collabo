<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class TeamTotal extends Model
{
    public function team()
    {
        return $this->belongsTo(Team::class);

    }
}
