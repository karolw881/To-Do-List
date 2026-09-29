@extends('layouts.app')
@section('title', 'Task list')

@section('content')

    @forelse ($tasksx as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->title }}</a>
        </div>
    @empty
        <div> There are no tasks!</div>
    @endforelse
@endsection