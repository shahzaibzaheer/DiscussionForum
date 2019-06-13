<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['title','slug'];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
