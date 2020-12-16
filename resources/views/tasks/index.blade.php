@extends('layouts.app')

@section('content')

<h1>Task List</h1>

    @if (count($tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Todo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $tasks)
                <tr>
                    <td>{!! link_to_route('tasks.show', $tasks->content, ['task' => $tasks->id]) !!}</td>
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
                          {{ method_field('get') }}
                          <button type="submit" class="btn btn-danger">Delete</button>
                         </form>
                    </td>
                    
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {{-- タスク作成ページへのリンク --}}
    {!! link_to_route('tasks.create', 'New Task', [], ['class' => 'btn btn-primary']) !!}


@endsection