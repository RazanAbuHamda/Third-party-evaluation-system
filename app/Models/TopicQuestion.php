<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicQuestion extends Model
{
    use HasFactory;
    public function topic(){
        $this->belongsTo(Topic::class);
    }
}
