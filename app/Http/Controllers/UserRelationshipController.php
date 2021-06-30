<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\UserRelationship;
class UserRelationshipController extends Controller
{
    public function index(){
        $user = auth()->user();
        $friends = $user->relationships()->where('type', 'F')->get();
        return view('userRelationship.index', compact('friends'));
    }
    public function requestIndex(){
        $user = auth()->user();
        $requestors = $user->relationships()->where('type', 'R')->get();
        return view('userRelationship.requestIndex', compact('requestors'));
    }
    public function update(){
        $user = auth()->user();
        $relationship = UserRelationship::where('user_id', $user['id'])->where('related_id', request('requestor_id'))->first();
        $relationship_reverese = UserRelationship::where('user_id', request('requestor_id'))->where('related_id', $user['id'])->first();
        $relationship->update([
            'type' => 'F'
        ]);
        $relationship_reverese->update([
            'type' => 'F'
        ]);
        return redirect()->back();
    }
    public function store(){
        $user = auth()->user();
        $relationship = UserRelationship::where('user_id', $user['id'])->where('related_id', request('user_id'))->first();

        if($relationship == null){
            UserRelationship::create([
                'user_id' => auth()->user()['id'],
                'related_id' => request('user_id'),
                'type' => 'R'
            ]);
            UserRelationship::create([
                'user_id' => request('user_id'),
                'related_id' => auth()->user()['id'],
                'type' => 'R'
            ]);
        }
        
        return redirect()->back();
    }
    public function destroy($related_id){
        $user = auth()->user();
        // $relationship = $user->relationships()->where('related_id', $related_id)->get();
        $relationship = UserRelationship::where('user_id', $user['id'])->where('related_id', $related_id)->first();
        $relationship_reverese = UserRelationship::where('user_id', $related_id)->where('related_id', $user['id'])->first();
        //
        $relationship->delete();
        $relationship_reverese->delete();
        return redirect()->back();
    }
}
