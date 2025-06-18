<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailNotifications extends Model
{
    //

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withTimestamps();
    }
}
