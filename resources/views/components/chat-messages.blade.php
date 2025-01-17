@props(['messages' => []])

<div class="messages flex-1 overflow-y-auto p-4 space-y-4">
    @foreach($messages as $message)
        @include('receive', ['message' => $message])
    @endforeach
</div>