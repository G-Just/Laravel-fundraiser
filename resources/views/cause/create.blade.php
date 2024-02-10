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
                <x-input-label for="description" :value="__('Description (max 1000 characters)')" />
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
                            let text = document.createTextNode('#' + input.value.split(' ').join('') + ` X`);
                            let p = document.createElement('p');
                            let hiddenInput = document.createElement('input');
                            container.appendChild(p);
                            container.appendChild(hiddenInput);
                            hiddenInput.setAttribute('type', 'hidden')
                            hiddenInput.setAttribute('value', input.value.split(' ').join(''))
                            hiddenInput.setAttribute('name', `hashtags[${iter}]`)
                            hiddenInput.classList.add('hidden-tag-input')
                            iter++;
                            p.appendChild(text);
                            p.classList.add('cursor-pointer', 'rounded-xl', 'tag', 'text-sm', 'bg-gray-900', 'px-2', 'py-0.5');
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
                    <x-text-input step="0.1" id="goal" class="block w-full mt-1" type="number" name="goal"
                        :value="old('goal')" autofocus autocomplete="goal" oninput="displayGoal(event)" />
                    <x-input-error :messages="$errors->get('goal')" class="mt-2" />
                </div>
                <div class="my-2">
                    <p id="goal-show"></p>
                </div>
                <script>
                    const goalContainer = document.getElementById('goal-show')
                    const goalInput = document.querySelector('#goal');

                    function displayGoal(event) {
                        goalContainer.innerHTML = 'Goal: $' + (+event.target.value).toLocaleString('en-US', {
                            minimumFractionDigits: 2
                        }) + ' USD';
                    }
                </script>


                <!-- Thumbnail -->
                <div class="mt-4">
                    <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                    <x-text-input id="thumbnail" class="block w-full mt-1" type="file" name="thumbnail"
                        :value="old('thumbnail')" autofocus autocomplete="thumbnail" />
                    <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                </div>

                <!-- Images -->
                <x-input-label class="mt-4 mb-2" for="images" :value="__('Images')" />
                <div id='images' class="relative border border-gray-500 border-dashed">
                    <input type="file" multiple name='images[]'
                        class="relative z-50 block w-full h-full p-20 opacity-0 cursor-pointer">
                    <div class="absolute top-0 left-0 right-0 p-10 m-auto text-center">
                        <h4>
                            Drop files anywhere to upload
                            <br />or
                        </h4>
                        <p>Select Files</p>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
        </form>
    </div>
</x-app-layout>
