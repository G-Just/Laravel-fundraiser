@props([
    'id' => 0,
    'thumbnail' => '',
    'title' => 'Failed to load, contact admin',
    'hashtags' => [],
    'description' => '',
    'goal' => 'Failed to load, contact admin',
    'collected' => '25.00',
])
<div class="relative">
    <a href="{{ route('cause.show', ['cause' => $id]) }}"
        class="flex flex-col bg-white rounded-lg lg:max-h-64 lg:flex-row dark:bg-gray-800">
        <img class="object-cover w-screen rounded-t-lg max-h-64 lg:max-h-full lg:rounded-t-none lg:rounded-l-lg lg:w-1/3"
            src="{{ $thumbnail }}" alt="Thumbnail">
        <div class="w-full px-2 pt-4 pb-6 lg:p-4">
            <div class="flex flex-col gap-2 lg:flex-row lg:gap-5">
                <h1 class="text-4xl text-left text-nowrap">{{ $title }}</h1>
                <div class="flex flex-wrap items-start w-full gap-2 lg:w-4/5">
                    @if ($hashtags)
                        @foreach ($hashtags as $hashtag)
                            <x-hashtag :value="$hashtag" />
                        @endforeach
                    @endif
                </div>
            </div>
            <p class="h-24 mt-2 overflow-y-auto">{{ $description }}</p>
            <div class="flex w-full gap-2 mt-4 lg:w-2/3">
                <x-money :value="$collected" />
                <div class="flex w-full border border-gray-500">
                    <div class="w-1/2 bg-indigo-500"></div>
                </div>
                <x-money :value="$goal" />
            </div>
        </div>
    </a>
</div>
