<x-app-layout>
    <div class="w-screen lg:w-[900px] flex flex-col gap-6 p-4 dark:bg-gray-800 border dark:border-gray-700 rounded-xl">
        <div class="relative">
            <h1 class="text-5xl text-left">{{ $cause->title }}</h1>
            <x-donation-list class="-top-4 -right-[300px]" :donations="$cause->donations()->get()" />
        </div>
        <div class="flex flex-col gap-4">
            <img class="object-cover col-span-4 rounded-xl" src="{{ $cause->getThumbnail() }}" alt="Thumbnail">
            <div class="flex gap-4 overflow-x-auto">
                @foreach ($cause->getImages() as $key => $image)
                    <x-image-dialog :img="$image" :iter="$key" />
                @endforeach
            </div>
        </div>
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
        @if ($cause->goal > $cause->collected)
            <div class="flex flex-col items-center w-full gap-4">
                <x-progress-bar :goal="$cause->goal" :collected="$cause->collected" />
                <div class="flex">
                    <p>Only&nbsp;</p>
                    <x-money class="text-center" :value="$cause->goal - $cause->collected" />
                    <p>&nbsp;USD left to reach the goal!</p>
                </div>
                <div class="mt-2">
                    <x-input-label class="text-center" for="donate" :value="__('Donate')" />
                    <hr class="my-2">
                    <form class="flex gap-2" action="{{ route('cause.donate', $cause) }}" method="post">
                        @csrf
                        <div class="relative">
                            <x-text-input id="donate" step="0.1" type="number" name="donation"
                                oninput="show(event)" id='donation' placeholder="Donation amount" />
                            <x-input-error :messages="$errors->get('donation')" />
                        </div>
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
        @else
            <div class="flex justify-center">
                <x-money :value="$cause->goal" />
                <p>&nbsp;Collected!</p>
            </div>
        @endif
    </div>

</x-app-layout>
