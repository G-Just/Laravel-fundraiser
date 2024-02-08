@props([
    'id' => 0,
    'thumbnail' => 'https://www.pixel4k.com/wp-content/uploads/2024/01/sunset-lands-art-4k_1706235364.jpg.webp',
    'title' => 'Title',
    'hashtags' => ['#HashTag'],
    'description' =>
        'Description goes here Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam veniam dicta cumque reprehenderit hic modi possimus eaque earum architecto laboriosam odit quam voluptate repellendus suscipit nesciunt fuga sapiente eveniet commodi quia, atque repudiandae quis qui. Pariatur esse id voluptatem, sit eum nihil quis. Id, odio? Reiciendis consequuntur laborum voluptatum soluta?',
    'goal' => '50.00',
    'collected' => '25.00',
])

<a href="{{ route('cause.show', ['cause' => $id]) }}"
    class="flex flex-col bg-white rounded-lg lg:max-h-64 lg:flex-row dark:bg-gray-800">
    <img class="object-cover w-full rounded-t-lg max-h-64 lg:max-h-full lg:rounded-t-none lg:rounded-l-lg lg:w-1/3"
        src="{{ $thumbnail }}" alt="Thumbnail">
    <div class="px-2 pt-4 pb-6 lg:p-4">
        <div class="flex flex-col gap-2 lg:flex-row lg:gap-5">
            <h1 class="text-4xl text-center lg:text-left">{{ $title }}</h1>
            <div class="flex flex-wrap items-start w-full gap-2 lg:w-4/5">
                @foreach ($hashtags as $hashTag)
                    <p class="text-sm rounded-xl px-2 py-0.5 bg-gray-900">{{ $hashTag }}</p>
                @endforeach
            </div>
        </div>
        <p class="h-24 mt-2 overflow-y-auto">{{ $description }}</p>
        <div class="flex w-full gap-2 mt-4 lg:w-2/3">
            <p><span class="mr-0.5">$</span>{{ $collected }}</p>
            <div class="flex w-full border border-gray-500">
                <div class="w-1/2 bg-indigo-500"></div>
            </div>
            <p><span class="mr-0.5">$</span>{{ $goal }}</p>
        </div>
    </div>
</a>
