<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'user_id',
        'result_json',
    ];
    protected $casts = [
        'result_json' => 'array',
    ];
    public function form()
    {
        return $this->belongsTo(EvaluationForm::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
