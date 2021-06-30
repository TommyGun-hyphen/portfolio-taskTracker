<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Project;
use \App\Models\sharedProject;
use \App\Models\UserRelationship;
class UserController extends Controller
{
    public function show($user_id){
        $relationship = [];
        $projects_shared = [];
        $projects_public = Project::where('user_id', $user_id)->where('is_public', true)->limit(3)->get();
        $user = User::find($user_id);
        if(auth()->check()){
            $this_user = auth()->user();//!the current logged in user!!!!! DO NOT CONFUSE
            $relationship = UserRelationship::where('user_id', auth()->user()['id'])->first();
            $projects_shared = $this_user->sharedProjects()->get()->where('user_id', $user->id);

            
        }
        return view('user.show', compact('user', 'relationship', 'projects_public', 'projects_shared'));
    }
}
