<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function projects(){
        return $this->hasMany(\App\Models\Project::class);
    }
    public function relationships(){
        return $this->belongsToMany(\App\Models\User::class, 'user_relationships', 'user_id', 'related_id');
    }
    public function reverseRelationships(){
        return $this->belongsToMany(\App\Models\User::class, 'user_relationships', 'related_id', 'user_id');
    }
    public function sharedProjects(){
        return $this->belongsToMany(\App\Models\Project::class, 'shared_projects', 'user_id');
    }
}
