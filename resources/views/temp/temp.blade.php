Hello i'm blade template

@isset($name)
The list of taska
@endisset

<div>
    @if(count($tasks))
    @foreach ($tasks as $task)
        <div>
            <h3>{{ $task->title }}</h3>
            <p>{{ $task->description }}</p>
        </div>
    @endforeach
    @else
    <div> There are no tasks!</div>  
    @endif
</div>