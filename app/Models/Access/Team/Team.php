<?php

namespace App\Models\Access\Team;

use Mpociot\Teamwork\TeamworkTeam;


class Team extends TeamworkTeam
{
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function events()
    {
        return $this->hasOne(Event::class);
    }
    public function totals()
    {
       return $this->hasMany('App\Models\Dashboard\Total');
    }


}
