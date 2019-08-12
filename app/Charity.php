<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
