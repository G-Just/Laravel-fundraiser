<x-app-layout>
    <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex flex-col gap-8 text-gray-900 dark:text-gray-100">
                @forelse ($causes as $cause)
                    <x-listing :page="$causes->currentPage()" :id="$cause->id" :thumbnail="$cause->getThumbnail()" :title="$cause->title" :hashtags="$cause->getHashTags()"
                        :description="$cause->description" :goal="$cause->goal" :collected="$cause->collected ?? 0" :editable="true" />
                @empty
                    <p>No causes in queue</p>
                @endforelse
            </div>
        </div>
        <div class="flex justify-center pb-4 mt-8">{{ $causes->links() }}</div>
    </div>
</x-app-layout>
