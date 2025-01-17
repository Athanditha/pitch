@props(['user'])

<td class="px-6 py-4 whitespace-nowrap">
    <div class="flex items-center">
        <div class="flex-shrink-0 h-10 w-10">
            <img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
        </div>
        <div class="ml-4">
            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                {{ $user->name }}
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ $user->username }}
            </div>
        </div>
    </div>
</td>
<td class="px-6 py-4 whitespace-nowrap">
    <div class="text-sm text-gray-900 dark:text-gray-100">{{ $user->email }}</div>
    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->contact_no }}</div>
</td>
<td class="px-6 py-4 whitespace-nowrap">
    <div class="flex items-center">
        <span class="text-yellow-400 mr-1">★</span>
        <span class="text-sm text-gray-900 dark:text-gray-100">
            {{ number_format($user->rating, 1) }}
        </span>
    </div>
</td>
<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
    <a href="/message" 
       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
        </svg>
        Chat
    </a>
</td> 