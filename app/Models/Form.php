<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'name',
    ];
    use HasFactory;
    public function topicQuestions(){
        return $this->hasMany(TopicQuestion::class);
    }
}
