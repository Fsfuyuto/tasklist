<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->pagenate(10);
        
        return view('users.index',[
            'users'=>$users,
            ]);
    }
    
    public function show($id)
    {
        // $user = User::findOrFail($id);
        
        // $user->loadRelationshipCount();
        
        // $task = $user->$tasks()->orderBy('created_at','desc')->pagenate(10);
        
        // return view('users.show',[
        //     'user'=> $user,
        //     'task'=> $task,
        //     ]);
        
        $user = User::findOrFail($id);
        $user->loadRelationshipCount();
        
        
        $task = $user->tasks();

        // メッセージ詳細ビューでそれを表示
        return view('users.show', [
            'user'=>$user,
            'task'=>$task,
        ]);
    }
    
    
}
