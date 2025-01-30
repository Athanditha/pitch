<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pitch</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- JavaScript -->
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
  @stack('styles')
</head>

<body class="bg-gradient-to-br from-purple-900 via-purple-700 to-purple-600 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
        <x-navbar>
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 transition">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-purple-600 transition">Register</a>
                @endauth
            </div>
        </x-navbar>
        
        <x-chat-messages :messages="[
            'Hey! What\'s up! 👋',
            'Ask a friend to open this link and you can chat with them!'
        ]" />

        <x-chat-form :csrf_token="csrf_token()" />

        <!-- Original chat messages section before refactoring:
        <div class="messages flex-1 overflow-y-auto p-4 space-y-4">
            @include('receive', ['message' => "Hey! What's up! 👋"])
            @include('receive', ['message' => "Ask a friend to open this link and you can chat with them!"])
        </div>
        -->

        <!-- Original chat form and JavaScript before refactoring:
        <div class="p-4 bg-gray-100 border-t">
            <form class="flex items-center space-x-2">
                <input 
                    type="text" 
                    id="message" 
                    name="message" 
                    placeholder="Enter message..." 
                    autocomplete="off" 
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                >
                <button 
                    type="submit" 
                    class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                    Send
                </button>
            </form>
        </div>

        <script>
            const pusher = new Pusher("{{ config('broadcasting.connections.pusher.key') }}", { cluster: 'ap2' });
            const channel = pusher.subscribe('public');

            // Receive messages
            channel.bind('chat', function (data) {
                $.post("/receive", {
                    _token: '{{ csrf_token() }}',
                    message: data.message,
                })
                    .done(function (res) {
                        $(".messages").append(res);
                        $(".messages").scrollTop($(".messages")[0].scrollHeight);
                    });
            });

            // Broadcast messages
            $("form").submit(function (event) {
                event.preventDefault();

                $.ajax({
                    url: "/broadcast",
                    method: 'POST',
                    headers: {
                        'X-Socket-Id': pusher.connection.socket_id
                    },
                    data: {
                        _token: '{{ csrf_token() }}',
                        message: $("#message").val(),
                    }
                }).done(function (res) {
                    $(".messages").append(res);
                    $("#message").val('');
                    $(".messages").scrollTop($(".messages")[0].scrollHeight);
                });
            });
        </script>
        -->
    </div>

    @stack('scripts')
</body>
</html>
