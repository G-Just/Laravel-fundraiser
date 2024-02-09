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
                <x-input-label for="description" :value="__('Description (max 500 characters)')" />
                <x-textarea-input rows="5" id="description" class="block w-full mt-1" type="text"
                    name="description" :value="old('description')" autofocus autocomplete="description" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Hash-tags -->
            <div class="mt-4">
                <x-input-label for="hashtag" :value="__('#HashTags (seperate by spaces)')" />
                <x-text-input id="hashtag" class="block w-full mt-1" type="text" autofocus
                    autocomplete="hashtag" />
                <x-input-error :messages="$errors->get('hashtag')" class="mt-2" />
                <div id="tag-container" class="flex flex-wrap gap-2 my-2">
                </div>

                <script>
                    let input, hashtagArray, container, t;
                    let iter = 0;

                    input = document.querySelector('#hashtag');
                    container = document.querySelector('#tag-container');
                    hashtagArray = [];

                    input.addEventListener('keyup', () => {
                        if (event.code == 'Space' && input.value.length > 0) {
                            let text = document.createTextNode('#' + input.value + `X`);
                            let p = document.createElement('p');
                            let hiddenInput = document.createElement('input');
                            container.appendChild(p);
                            container.appendChild(hiddenInput);
                            hiddenInput.setAttribute('type', 'hidden')
                            hiddenInput.setAttribute('value', input.value)
                            hiddenInput.setAttribute('name', `hashtags[${iter}]`)
                            hiddenInput.classList.add('hidden-tag-input')
                            iter++;
                            p.appendChild(text);
                            p.classList.add('tag');
                            p.classList.add('text-sm');
                            p.classList.add('bg-gray-900');
                            p.classList.add('bg-gray-900');
                            p.classList.add('px-2');
                            p.classList.add('py-0.5');
                            p.classList.add('rounded-xl');
                            p.classList.add('cursor-pointer');
                            input.value = '';
                            let deleteTags = document.querySelectorAll('.tag');
                            let hiddenInputs = document.querySelectorAll('.hidden-tag-input');
                            for (let i = 0; i < deleteTags.length; i++) {
                                deleteTags[i].addEventListener('click', () => {
                                    container.removeChild(deleteTags[i]);
                                    container.removeChild(hiddenInputs[i]);
                                });
                            }
                        }
                    });
                </script>

                <!-- Goal -->
                <div class="mt-4">
                    <x-input-label for="goal" :value="__('Goal')" />
                    <x-text-input id="goal" class="block w-full mt-1" type="number" name="goal"
                        :value="old('goal')" autofocus autocomplete="goal" />
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
