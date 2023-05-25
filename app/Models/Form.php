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

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    protected $fillable = [
        'name',
        'user_id',
        'form_data',
        'enterprise_id'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'form_data' => 'array',
    ];
}
