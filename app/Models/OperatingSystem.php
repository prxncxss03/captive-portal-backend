<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class OperatingSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

    ];

    public function device(){
        return $this->hasMany(User::class);
    }

    
}   
