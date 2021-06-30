<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }
    public function project(){
        return $this->belongsTo(\App\Models\Project::class);
    }
}
