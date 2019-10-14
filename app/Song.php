<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['name','path'];
    
    public function genre(){
        return $this->belongsTo('App\Genre');
    }
    
    
}
