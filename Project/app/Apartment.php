<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $table = 'apartments';

    public function user(){
      return $this -> belongsTo(User::class);
    }

    public function messages(){
      return $this -> hasMany(Message::class);
    }

    public function sponsors(){
      return $this -> belongsToMany(Sponsor::class);
    }

    public function optionals(){
      return $this -> belongsToMany(Optional::class);
    }
}
