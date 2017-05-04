<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;
//use Mpociot\Teamwork\Traits\UsedByTeams;

class Event extends Model
{
//    use UsedByTeams;

     public function team()
    {
        return $this->belongsTo(Team::class);

    }
}
