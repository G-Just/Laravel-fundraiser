<x-app-layout>
    <div class="lg:w-[900px] flex flex-col gap-6 p-4 bg-gray-800 border border-gray-700 rounded-xl">
        <div class="relative">
            <h1 class="text-5xl text-left">{{ $cause->title }}</h1>
            <x-donation-list class="-top-4 -right-[300px]" :donations="$cause->donations()->get()" />
        </div>
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
        <hr>
        <div class="flex flex-col items-center w-full gap-4">
            <x-progress-bar :goal="$cause->goal" :collected="$cause->collected" />
            <div class="flex">
                <p>Only&nbsp;</p>
                <x-money class="text-center" :value="$cause->goal - $cause->collected" />
                <p>&nbsp;USD left to reach the goal!</p>
            </div>
            <div class="flex mt-2">
                <form action="{{ route('cause.donate', $cause) }}" method="post">
                    @csrf
                    <x-text-input step="0.1" type="number" name="donation" oninput="show(event)" id='donation'
                        placeholder="Donation amount" />
                    <x-primary-button>Donate</x-primary-button>
                </form>
            </div>
            <div class="my-2">
                <p class="text-center" id="display"></p>
            </div>
            <script>
                const display = document.getElementById('display')

                function show(event) {
                    display.innerHTML = 'Donation: $' + (+event.target.value).toLocaleString('en-US', {
                        minimumFractionDigits: 2
                    }) + ' USD';
                }
            </script>
        </div>
    </div>
</x-app-layout>
