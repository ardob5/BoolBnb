<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    public function apartment() {
        return $this->belongsTo(Apartment::class);
    }
}
