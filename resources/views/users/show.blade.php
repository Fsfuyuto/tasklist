@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->


    <h1> Task Detail</h1>

    <table class="table table-bordered">
        <tr>
            <th>Task</th>
            <td>{!! nl2br(e($user->content)) !!}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $user->task}}</td>
        </tr>
    </table>

    <div class="col-2 d-flex">
     {{-- タスク編集ページへのリンク --}}
     <div class="mr-2">
  
     </div>

     {{-- タスク削除フォーム --}}
   
    </div>
@endsection
    
    

