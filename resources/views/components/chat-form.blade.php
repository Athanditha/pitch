@props(['csrf_token'])

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

@push('scripts')
<script>
  const pusher = new Pusher("{{ config('broadcasting.connections.pusher.key') }}", { cluster: 'ap2' });
  const channel = pusher.subscribe('public');

  // Receive messages
  channel.bind('chat', function (data) {
    $.post("/receive", {
      _token: '{{ $csrf_token }}',
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
        _token: '{{ $csrf_token }}',
        message: $("#message").val(),
      }
    }).done(function (res) {
      $(".messages").append(res);
      $("#message").val('');
      $(".messages").scrollTop($(".messages")[0].scrollHeight);
    });
  });
</script>
@endpush 