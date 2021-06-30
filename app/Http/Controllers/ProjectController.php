<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\SharedProject;
use App\Models\User;
class ProjectController extends Controller
{
    public function index(){
        $user = auth()->user();
        $projects = Project::where('user_id', $user['id'])->get();
        return view('project.index', compact('projects'));
    }
    public function create(){
        return view('project.create');
    }
    public function store(){
        request()->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:15'
        ]);
        $is_public = false;
        if(request('is_public') == 'true'){
            $is_public = true;
        }
        Project::create([
            'title' => request('title'),
            'description' => request('description'),
            'color' => request('color'),
            'user_id' => auth()->user()['id'],
            'is_public' => $is_public
        ]);
        return redirect('/project');
    }
    public function show($project_id){
        $tasks = Task::where('project_id', $project_id)->get();
        $project = Project::where('id', $project_id)->firstOrFail();
        return view('project.show', ["tasks" => $tasks, "project" => $project]);
    }
    public function edit($project_id){
        $project = Project::where('id',$project_id)->firstOrFail();
        return view('project.edit', compact('project'));
    }
    public function update($project_id){
        $project = Project::where('id',$project_id)->firstOrFail();
        request()->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:15',
            'is_public' => 'required'
        ]);
        $project->title = request('title');
        $project->description = request('description');
        $project->color = request('color');
        if(request('is_public') == "true"){
            $project->is_public = true;
        }else if(request('is_public') == "false"){
            $project->is_public = false;
        }else{
            return redirect()->back();
        } 
        $project->save();
        return redirect('/project');
    }
    public function destroy($project_id){
        $project = Project::where('id',$project_id)->firstOrFail();
        $project->delete();
        return redirect()->back();
    }
    public function shareIndex($project_id){
        $user = auth()->user();
        if($user->projects()->where('id', $project_id)->get()->Count() == 1){
            $project = Project::where('id',$project_id)->firstOrFail();
            $friends = $user->relationships()->where('type', 'F')->paginate(10);
            // $already_shared = $project->sharedTo()->get();
            // $friends = $friends->diff($already_shared->toArray());
            $project = Project::where('id',$project_id)->firstOrFail();
            return view('project.shareIndex', compact('friends', 'project'));
        }else{
            return redirect()->back();
        }
    }
    public function share($project_id, $project_slug){
        $user = auth()->user();
        if($user->projects()->where('id', $project_id)->get()->Count() == 1){
            $friend = User::find(request('friend_id'));
            if($friend->sharedProjects()->where('project_id', $project_id)->get()->Count() == 0){
                SharedProject::create([
                    'user_id' => $friend->id,
                    'project_id' =>$project_id
                ]);
                return redirect('/project/'.$project_id.'-'.$project_slug.'/share');
            }else{
                SharedProject::where('project_id', $project_id)->where('user_id', $friend->id)->delete();
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
}
