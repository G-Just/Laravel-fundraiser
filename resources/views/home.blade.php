<x-app-layout>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex flex-col gap-8 text-gray-900 dark:text-gray-100">
                <x-filter-menu />
                @if ($private)
                    <x-listing :id="$private->id" :thumbnail="$private->getThumbnail()" :title="$private->title" :hashtags="$private->getHashTags()" :description="$private->description"
                        :goal="$private->goal" :collected="$private->collected" :editable="true" />
                    <hr>
                @endif
                @forelse ($causes as $cause)
                    <x-listing :page="$causes->currentPage()" :likes="$cause->likes->count()" :id="$cause->id" :thumbnail="$cause->getThumbnail()"
                        :title="$cause->title" :hashtags="$cause->getHashTags()" :description="$cause->description" :goal="$cause->goal"
                        :collected="$cause->collected ?? 0" />
                @empty
                    <p class="text-center">No data found</p>
                @endforelse
            </div>
        </div>
        <div class="flex justify-center pb-4 mt-8">{{ $causes->links() }}</div>
    </div>
</x-app-layout>
