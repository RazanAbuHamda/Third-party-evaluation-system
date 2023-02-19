<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use HasFactory;
    protected $fillable = [
        'enterprise_name',
        'email',
        'password',
        'status',
    ];
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
