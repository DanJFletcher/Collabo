<?php

namespace App\Models\Access\Team;

use Mpociot\Teamwork\TeamworkTeam;


class Team extends TeamworkTeam
{
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
