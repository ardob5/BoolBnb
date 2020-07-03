<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
  protected $table = 'sponsors';

  public function apartments(){

  return $this -> belongsToMany(Apartment::class);

  }
}
