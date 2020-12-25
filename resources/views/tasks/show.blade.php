@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->


    <h1> Task Detail</h1>
    <table class="table table-bordered">
    
        <tr>
            <th>Task</th>
            <td>{{ $task->content}}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $task->status }}</td>
        </tr>
    </table>

    <div class="col-2 d-flex">
     {{-- タスク編集ページへのリンク --}}
     <div class="mr-2">
    {!! link_to_route('tasks.edit', 'Edit', ['task' => $task->id], ['class' => 'btn btn-success']) !!}
     </div>

     {{-- タスク削除フォーム --}}
      <form action="{{ action('TasksController@destroy', $task) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
    </div>
@endsection