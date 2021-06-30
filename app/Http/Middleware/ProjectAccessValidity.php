<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use \App\Models\Project;
class ProjectAccessValidity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Access||  O: owner || S: shared || V: Visitor
        $request['access'] = "O";
        $project = Project::where('id',$request->route()->parameters()['project_id'])->firstOrFail();
        if($project->user_id != auth()->user()['id']){
            if($project->sharedTo()->where('user_id', auth()->user()['id'])->get()->Count() == 1){
                $request['access'] = "S";
            }else if($project->is_public){
                $request['access'] = "V";
            }else{
                return redirect('/home');
            }
            
        }
        //dd($request->input());
        return $next($request);
    }
}
