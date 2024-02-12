@props([
    'id' => 0,
    'thumbnail' => '',
    'title' => 'Failed to load, contact admin',
    'hashtags' => [],
    'description' => '',
    'goal' => 'Failed to load, contact admin',
    'collected' => 'Failed to load, contact admin',
    'editable' => false,
    'likes' => 0,
    'page' => 0,
])
<div class="relative">
    <a href="@if ($editable) {{ route('cause.edit', $id) }} @else {{ route('cause.show', $id) }} @endif"
        class="relative flex flex-col bg-white rounded-lg lg:max-h-64 lg:flex-row dark:bg-gray-800 min-w-[300px]">
        @if ($editable)
            <div
                class="absolute left-0 right-0 flex flex-col items-center justify-center -translate-y-1/2 bg-black bg-opacity-50 top-20 lg:top-1/2">
                <p>This cause is not yet approved</p>
                <p>Click to edit</p>
            </div>
        @endif
        <img class="object-cover w-screen rounded-t-lg max-h-64 lg:max-h-full lg:rounded-t-none lg:rounded-l-lg lg:w-1/3"
            src="{{ $thumbnail }}" alt="Thumbnail" />
        <div class="relative">
            @if (!$editable)
                <div class="absolute z-20 flex items-center gap-2 right-4 -bottom-14 lg:bottom-2 lg:left-[690px]">
                    @if (!auth()->check())
                        <form action="{{ route('cause.like', $id) }}" method="POST">
                            @csrf
                            <input type="hidden" name='page' value="{{ $page }}">
                            <button>
                                <svg class="w-10 h-10" viewBox="-2.4 -2.4 28.80 28.80" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                        stroke="#CCCCCC" stroke-width="0.048"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <rect width="24" height="24" fill="none"></rect>
                                        <path
                                            d="M21 8.99998C21 12.7539 15.7156 17.9757 12.5857 20.5327C12.2416 20.8137 11.7516 20.8225 11.399 20.5523C8.26723 18.1523 3 13.1225 3 8.99998C3 2.00001 12 2.00002 12 8C12 2.00001 21 1.99999 21 8.99998Z"
                                            stroke="#ff0000" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </button>
                        </form>
                    @else
                        @if (!auth()->user()->likes()->where('cause_id', '=', $id)->first())
                            <form action="{{ route('cause.like', $id) }}" method="POST">
                                @csrf
                                <input type="hidden" name='page' value="{{ $page }}">
                                <button>
                                    <svg class="w-10 h-10" viewBox="-2.4 -2.4 28.80 28.80" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                            stroke="#CCCCCC" stroke-width="0.048"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <rect width="24" height="24" fill="none"></rect>
                                            <path
                                                d="M21 8.99998C21 12.7539 15.7156 17.9757 12.5857 20.5327C12.2416 20.8137 11.7516 20.8225 11.399 20.5523C8.26723 18.1523 3 13.1225 3 8.99998C3 2.00001 12 2.00002 12 8C12 2.00001 21 1.99999 21 8.99998Z"
                                                stroke="#ff0000" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('cause.dislike', $id) }}" method="POST">
                                @csrf
                                <input type="hidden" name='page' value="{{ $page }}">
                                <button onclick="(e) => e.preventDefault()">
                                    <svg class="w-10 h-10" viewBox="-2.4 -2.4 28.80 28.80" fill="red"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                            stroke="#CCCCCC" stroke-width="0.048"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <rect width="24" height="24" fill="none"></rect>
                                            <path
                                                d="M21 8.99998C21 12.7539 15.7156 17.9757 12.5857 20.5327C12.2416 20.8137 11.7516 20.8225 11.399 20.5523C8.26723 18.1523 3 13.1225 3 8.99998C3 2.00001 12 2.00002 12 8C12 2.00001 21 1.99999 21 8.99998Z"
                                                stroke="#ff0000" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    @endif
                    <p>{{ $likes }}</p>
                </div>
            @endif
        </div>
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
</div>
