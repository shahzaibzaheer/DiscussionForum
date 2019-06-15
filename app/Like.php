<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id'];

    public function reply(){
        $this->belongsTo(Reply::class);
    }
}
