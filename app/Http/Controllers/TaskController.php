<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
class TaskController extends Controller
{
    public function index(){
        return redirect('/home');
    }
    public function create($project_id){
        $project = Project::where('id', $project_id)->firstOrFail();
        return view('task.create', compact('project'));
    }
    public function store($project_id, $project_slug){
        request()->validate([
            'title' => 'required|min:5'
        ]);
        Task::create([
            'project_id' => $project_id,
            'title' => \request('title'),
            'description' => \request('description'),
            'color' => \request('color'),
            'is_completed' => false
        ]);
        return \redirect('/project/'.$project_id.'-'.$project_slug);
    }
    public function edit($project_id, $project_slug, $task_id, $task_slug){
        $task = Task::where('id',$task_id)->firstOrFail();
        $project = Project::find($project_id);
        return view('task.edit', compact('task', 'project'));
    }
    public function update($project_id, $project_slug, $task_id, $task_slug){
        $task = Task::where('id',$task_id)->firstOrFail();
        if(request('title') !== null || request('description') !== null || request('color') !== null){
            request()->validate([
                'title' => 'required|min:5'
            ]);
            $task->title = request('title');
            $task->description = request('description');
            $task->color = request('color');
            if(request()->has('is_completed')){
                $task->is_completed = true;
            }else{
                $task->is_completed = false;
            }
        }else{
            if(request('is_completed') == "true"){
                $task->is_completed = true;
            }else{
                $task->is_completed = false;
            }
        }
        
        $task->save();
        return redirect('/project/'.$project_id.'-'.$project_slug);
    }
    public function destroy($project_id, $task_id){
        $task = Task::where('id',$task_id)->firstOrFail();
        $task->delete();
        return redirect()->back();
    }
}
