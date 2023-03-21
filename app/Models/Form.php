<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Form extends Authenticatable
{
    protected $fillable = [
        'name',
        'user_id',
        'form_data'
    ];
    use HasFactory, Notifiable;

    protected $hidden = [
        'remember_token',
    ];
}
