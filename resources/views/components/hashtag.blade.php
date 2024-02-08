@props(['value'])

<p class="text-sm rounded-xl px-2 py-0.5 bg-gray-900">{{ $value ?? $slot }}</p>
