<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    //

    public function charity()
    {
        return $this->belongsTo(Charity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
