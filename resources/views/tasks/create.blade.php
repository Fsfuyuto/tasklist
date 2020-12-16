@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
 <h1>Create New Task</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($task, ['route' => 'tasks.store']) !!}

                <div class="form-group">
                    {!! Form::label('content', 'Task:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection