@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
<h1>Edit Task</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('content', 'Task:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Updates', ['class' => 'btn btn-success']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection