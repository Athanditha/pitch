<header class="w-full p-4 bg-gray-800">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="text-2xl font-bold text-indigo-400">
            <a href="{{ auth()->check() ? '/dashboard' : '/' }}">Pitch</a>
        </div>
        <!-- Navigation Links -->
        <nav>
            <ul class="flex space-x-4">
                @auth
                    <li><a href="{{ route('dashboard') }}" class="hover:text-indigo-300">Dashboard</a></li>
                    <li><a href="/message" class="hover:text-indigo-300">Chats</a></li>
                @endauth
            </ul>
        </nav>
        <!-- Login/Register/Profile -->
        <div class="flex items-center space-x-4">
            @auth
                <!-- Profile dropdown -->
                <div class="relative">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-indigo-500 px-4 py-2 rounded-lg text-white hover:bg-indigo-600">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="bg-indigo-500 px-4 py-2 rounded-lg text-white hover:bg-indigo-600">Login</a>
                <a href="{{ route('register') }}" class="bg-indigo-500 px-4 py-2 rounded-lg text-white hover:bg-indigo-600">Register</a>
            @endauth
        </div>
    </div>
</header>
