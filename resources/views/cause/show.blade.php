<x-app-layout>
    <div class="flex flex-col gap-6 p-4 bg-gray-800 rounded-xl">
        <h1 class="text-5xl text-left">{{ $cause->title }}</h1>
        <img class="object-cover rounded-xl max-h-[500px]" src="{{ $cause->getThumbnail() }}" alt="Thumbnail">
        <div class="flex w-full">
            <p class="w-1/2">Created by: {{ $cause->owner()->first()->name ?? 'Not found' }}</p>
            <div class="flex flex-wrap items-center justify-end w-1/2 gap-2">
                @foreach ($cause->getHashTags() as $hashtag)
                    <x-hashtag :value="$hashtag" />
                @endforeach
            </div>
        </div>
        <hr>
        <p>Created: {{ explode(' ', $cause->created_at)[0] }}</p>
        <hr>
        <p>{{ $cause->description }}</p>
    </div>
    {{-- TODO: add a goal and progress bar (finish the page) --}}
</x-app-layout>
