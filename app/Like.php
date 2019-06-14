<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function reply(){
        $this->belongsTo(Reply::class);
    }
}
