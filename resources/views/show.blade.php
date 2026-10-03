@extends('layouts.app')

@section('title', $task->title)
@section('content')
    <div class="mb-4"></div>
    <a href="{{ route('tasks.index') }}" class="font-medium text-grey-700 underline decoration-pink-500"><- go back to the
            task list</a>

            <p class="mb-4 text-slate-700">{{ $task->description }}</p>

            @if ($task->long_description)
                <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>

            @endif

            <p class="mb-4 text-sm text-slate-500">Created {{ $task->created_at->diffForHumans() }} * Updated
                {{ $task->updated_at->diffForHumans() }} </p>

            <p class="mb-4"> @if ($task->completed)
            <span class="font-medium text-green-500">Completed</span>
             @else
            <span class="font-medium text-red-500">Incomplete</span>
             @endif
            </p>

            <div class = "flex gap-2">
                <a href="{{  route("tasks.edit", ['task' => $task]) }}"
                class = "btn" >Edit</a>
          
                <form action="{{ route('tasks.toggle-completed', ['task' => $task]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn">{{ $task->completed ? 'Mark as Incomplete' : 'Mark as Complete' }}</button>
                </form>
         
                <form method="POST" action="{{ route('tasks.destroy', ['task' => $task]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">Delete</button>
                </form>
            </div>
@endsection