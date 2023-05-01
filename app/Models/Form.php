<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Form extends Authenticatable
{
    use HasFactory, Notifiable;

    public function evaluationResults()
    {
        return $this->belongsTo(EvaluationResult::class);
    }
    protected $fillable = [
        'name',
        'user_id',
        'form_data'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'form_data' => 'array',
    ];
}
