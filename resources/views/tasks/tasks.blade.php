<!--@if (count($tasks) > 0)-->
    <!--<ul class="list-unstyled">-->
    <!--    @foreach ($tasks as $task)-->
    <!--        <tr>-->
    <!--                <td>{!! link_to_route('tasks.show', $tasks->content, ['task' => $tasks->id]) !!}</td>-->
    <!--                <td>{{ $tasks->status }}</td>-->
    <!--                <td>-->
    <!--                     <form action="{{ action('TasksController@edit', $tasks) }}" method="post">-->
    <!--                      {{ csrf_field() }}-->
    <!--                      {{ method_field('get') }}-->
    <!--                      <button type="submit" class="btn btn-success">Edit</button>-->
    <!--                     </form>-->
    <!--                </td>-->
    <!--                <td>-->
    <!--                     <form action="{{ action('TasksController@destroy', $tasks) }}" method="post">-->
    <!--                      {{ csrf_field() }}-->
    <!--                      {{ method_field('get') }}-->
    <!--                      <button type="submit" class="btn btn-danger">Delete</button>-->
    <!--                     </form>-->
    <!--                </td>-->
                    
                    
    <!--            </tr>-->
    <!--    @endforeach-->
    <!--</ul>-->
    
    {{-- ページネーションのリンク --}}
<!--    {{ $tasks->links() }}-->
<!--@endif-->
@if (count($tasks) > 0)
    <ul class="list-unstyled">
        @foreach ($tasks as $task)
            <li class="media mb-12">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $task->user->name, ['user' => $task->user->id]) !!}
                        <span class="text-muted">posted at {{ $task->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                         <p class="mb-0">{!! nl2br(e($task->status)) !!}</p>
                        <p class="mb-0">{!! nl2br(e($task->content)) !!}</p>
                    </div>
                     <div>
                        @if (Auth::id() == $task->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $tasks->links() }}
@endif