<x-app-layout>
    <div class="w-full px-6 py-4 overflow-hidden bg-white shadow-md sm:max-w-2xl dark:bg-gray-800 sm:rounded-lg">
        <form enctype="multipart/form-data" method="POST" action="{{ route('cause.store') }}">
            @csrf

            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block w-full mt-1" type="text" name="title" :value="old('title')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <x-textarea-input rows="5" id="description" class="block w-full mt-1" type="text"
                    name="description" :value="old('description')" autofocus autocomplete="description" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Hash-tags -->
            <div class="mt-4">
                <x-input-label for="hashtag" :value="__('#HashTags')" />
                <x-text-input id="hashtag" class="block w-full mt-1" type="text" name="hashtag" :value="old('hashtag')"
                    autofocus autocomplete="hashtag" />
                <x-input-error :messages="$errors->get('hashtag')" class="mt-2" />
            </div>

            <!-- Hash-tags -->
            <div class="mt-4">
                <x-input-label for="goal" :value="__('Goal')" />
                <x-text-input id="goal" class="block w-full mt-1" type="number" name="goal" :value="old('goal')"
                    autofocus autocomplete="goal" />
                <x-input-error :messages="$errors->get('goal')" class="mt-2" />
            </div>

            <!-- Thumbnail -->
            <div class="mt-4">
                <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                <x-text-input id="thumbnail" class="block w-full mt-1" type="file" name="thumbnail"
                    :value="old('thumbnail')" autofocus autocomplete="thumbnail" />
                <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
