<x-app-layout>
    <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex flex-col gap-8 text-gray-900 dark:text-gray-100">
                @forelse ($causes as $cause)
                    <x-listing :id="$cause->id" :thumbnail="$cause->displayThumbnail()" :title="$cause->title" :hashtags="$cause->hastags" :description="$cause->description"
                        :goal="$cause->goal" />
                @empty
                    <p>No data found</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
