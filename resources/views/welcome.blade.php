@extends('layouts.app')

@section('content')
    @if (Auth::check())
        
        <div class="row">
            <aside class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ Auth::user()->name }}</h3>
                    </div>
                    <h1 class="p-2">Task List</h1>


   <table class="table table-striped">
            <thead>
                <tr>
                    <th>Todo</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
            </thead>
            <tbody>
                @foreach ($tasks as $tasks)
                <tr>
                    <td>{!! link_to_route('tasks.show', $tasks->content, ['task' => $tasks->id]) !!}</td>
                    <td>{{ $tasks->status }}</td>
                    <td>
                         <form action="{{ action('TasksController@edit', $tasks) }}" method="post">
                          {{ csrf_field() }}
                          {{ method_field('get') }}
                          <button type="submit" class="btn btn-success">Edit</button>
                         </form>
                    </td>
                    <td>
                         <form action="{{ action('TasksController@destroy', $tasks) }}" method="post">
                          {{ csrf_field() }}
                          {{ method_field('delete') }}
                          <button type="submit" class="btn btn-danger">Delete</button>
                         </form>
                    </td>
                    
                    
                </tr>
                @endforeach
            </tbody>
        </table>
       {{-- タスク作成ページへのリンク --}}
       <div class="mt-0">
        {!! link_to_route('tasks.create', 'New Task', [], ['class' => 'btn btn-primary']) !!}
       </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Tasklist</h1>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection