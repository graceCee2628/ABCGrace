<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
  public function comments(){
  	return $this->hasMany('App\Comment');
  }
  public function tickets(){
  	return $this->belongsTo('App\Ticket');
  }
  public function user(){
  	return $this->belongsTo('App\User');
  }    
}
