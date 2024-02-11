@props([
    'id' => 0,
    'thumbnail' => '',
    'title' => 'Failed to load, contact admin',
    'hashtags' => [],
    'description' => '',
    'goal' => 'Failed to load, contact admin',
    'collected' => 'Failed to load, contact admin',
    'editable' => false,
])

<a href="
@if ($editable) {{ route('cause.edit', $id) }} @else {{ route('cause.show', $id) }} @endif
"
    class="relative flex flex-col bg-white rounded-lg lg:max-h-64 lg:flex-row dark:bg-gray-800 min-w-[300px]">
    @if ($editable)
        <div
            class="absolute left-0 right-0 flex flex-col items-center justify-center -translate-y-1/2 bg-black bg-opacity-50 top-1/2">
            <p>This cause is not yet approved</p>
            <p>Click to edit</p>
        </div>
    @endif
    <img class="object-cover w-screen rounded-t-lg max-h-64 lg:max-h-full lg:rounded-t-none lg:rounded-l-lg lg:w-1/3"
        src="{{ $thumbnail }}" alt="Thumbnail" />
    <div class="flex flex-col w-full px-2 pt-4 pb-6 lg:p-4">
        <div class="flex flex-col gap-3 lg:flex-row lg:gap-5">
            <h1 class="text-4xl text-left text-nowrap">{{ $title }}</h1>
            <div class="flex flex-wrap items-start w-full gap-2 lg:w-4/5">
                @if ($hashtags)
                    @foreach ($hashtags as $hashtag)
                        <x-hashtag :value="$hashtag" />
                    @endforeach
                @endif
            </div>
        </div>
        <p class="mt-3 overflow-y-auto h-28">{{ $description }}</p>
        @if ($goal > $collected)
            <x-progress-bar :goal="$goal" :collected="$collected ?? 0" />
        @else
            <div class="flex">
                <x-money :value="$goal" />
                <p>&nbsp;Collected!</p>
            </div>
        @endif
    </div>
</a>
