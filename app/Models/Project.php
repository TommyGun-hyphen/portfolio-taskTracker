<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function tasks(){
        return $this->hasMany(\App\Models\Task::class);
    }
    public function sharedTo(){
        return $this->belongsToMany(\App\Models\User::class, 'shared_projects', 'project_id');
    }
}
