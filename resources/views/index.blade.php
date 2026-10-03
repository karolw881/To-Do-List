@extends('layouts.app')
@section('title', 'Task list')

@section('content')
<nav class = "mb-4"></nav>
    <a href ="{{ route('tasks.create') }}" class = "link">Add Task</a>
</nav>

    @forelse ($tasksx as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
               @class(['line-through'=> $task->completed])>{{ $task->title }}</a>
        </div>
    @empty
        <div> There are no tasks!</div>
    @endforelse

    @if ($tasksx->count())
        <nav class = "mt-4">
        {{ $tasksx->links() }}
        </nav>
        @endif
@endsection