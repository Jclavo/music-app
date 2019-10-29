<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['title','file','genre_id'];
    
    public function genre(){
        return $this->belongsTo('App\Genre');
    }
    
    
}
