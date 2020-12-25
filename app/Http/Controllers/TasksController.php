<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;  

class TasksController extends Controller
{
    
     // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    
    }

    // getでtasks/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $task = new Task;

        // メッセージ作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
            
        ]);
        
        
    }

    // postでtasks/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {

        // バリデーション
        $request->validate([
            'status' => 'required|max:10',   // 追加
            'content' => 'required|max:255',
        ]);
        
        // // メッセージを作成
        $task = new Task;
        $task->status = $request->status;    // 追加
        // $task->user_id = $request->user_id;
        $task->content = $request->content;
        $task->save();
        if(\Auth::id()===$task->user_id){
           $task->status = $request->status;    // 追加
           $task->content = $request->content;
        //   $task->user_id = $request->user_id;
           $task->save();
        }
        
        
        
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->tasks()->create([
            'status' => $request->status,
            // 'user_id'=>$request->user_id,
            'content' => $request->content,
        ]);

        
        // // 前のURLへリダイレクトさせる
        return back();
          // トップページへリダイレクトさせる
        // return redirect('/');
    }

    // getでtasks/（任意のid）にアクセスされた場合の「取得表示処理」
    public function show($id)
    {
       
        $task = Task::findOrFail($id);

        // メッセージ詳細ビューでそれを表示
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    // getでtasks/（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // // idの値でメッセージを検索して取得
        // $task = Task::findOrFail($id);

        $task = \App\Task::findOrFail($id);
        // // メッセージ編集ビューでそれを表示
        return view('tasks.edit', [
            'task' => $task,
        ]);
        
        // $task = \App\Task::findOrFail($id);
        // // メッセージを削除
        // if(\Auth::id()===$task->user_id){
        //     return view('tasks.edit',[
        //         'task'=>$task,
        //         ]);
        // }

        // // トップページへリダイレクトさせる
        // return redirect('/');
    }

    // putまたはpatchでtasks/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        
        // バリデーション
        $request->validate([
            'status' => 'required|max:10',   // 追加
            // 'user_id'=> 'required',
            'content' => 'required|max:255',
        ]);
        
        // idの値でメッセージを検索して取得
        // $task = Task::findOrFail($id);
        $task = \App\Task::findOrFail($id);
        // メッセージを更新
        // $task->status = $request->status;    // 追加
        // $task->content = $request->content;
        // $task->user_id = $request->user_id;
        // $task->save();
        
        if(\Auth::id()===$task->user_id){
           $task->status = $request->status;    // 追加
           $task->content = $request->content;
        //   $task->user_id = $request->user_id;
           $task->save();
        }
        

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    // deleteでmessages/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
      
        $task = \App\Task::findOrFail($id);
        // メッセージを削除
        if(\Auth::id()===$task->user_id){
            $task->delete();
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
