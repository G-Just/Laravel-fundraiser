<x-app-layout>
    <form enctype="multipart/form-data" action="{{ route('cause.update', $cause) }}" method="POST">
        @csrf
        <div
            class="w-screen lg:w-[900px] flex flex-col gap-6 p-4 dark:bg-gray-800 border dark:border-gray-700 rounded-xl">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block w-full mt-1" type="text" name="title" :value="$cause->title" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
            <div class="flex flex-col gap-4">
                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-thumbnail')"><img
                        class="object-cover col-span-4 cursor-pointer rounded-xl" src="{{ $cause->getThumbnail() }}"
                        alt="Thumbnail"></button>
                <x-modal name="edit-thumbnail">
                    <form enctype="multipart/form-data" action="{{ route('cause.update', $cause) }}" method="POST">
                        @csrf
                        <div class="flex flex-col p-4">
                            <img class="object-cover col-span-4 cursor-pointer rounded-xl"
                                src="{{ $cause->getThumbnail() }}" alt="Thumbnail">
                            <div class="my-4">
                                <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                                <x-text-input id="thumbnail" class="block w-full mt-1" type="file" name="thumbnail"
                                    autofocus />
                                <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                            </div>
                            <div class="flex justify-end gap-2">
                                <x-primary-button>
                                    {{ __('Change') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </x-modal>

                <div class="flex gap-4 overflow-x-auto">
                    @foreach ($cause->getImages() as $key => $image)
                        <button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'edit-image{{ $key }}')"><img
                                class="object-cover w-20 h-20 col-span-4 cursor-pointer" src="{{ $image }}"
                                alt="Image"></button>
                        <x-modal name="edit-image{{ $key }}">
                            <div class="flex flex-col p-4">
                                <img class="object-cover col-span-4 cursor-pointer rounded-xl" src="{{ $image }}"
                                    alt="Image">
                                <div class="my-4">
                                    <x-input-label for="image{{ $key }}" :value="__('Image')" />
                                    <x-text-input id="image{{ $key }}" class="block w-full mt-1"
                                        type="file" name="image{{ $key }}" autofocus />
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>
                                <div class="flex justify-end gap-2">
                                    <x-primary-button>
                                        {{ __('Change') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </x-modal>
                    @endforeach
                </div>
            </div>

            <div class="flex w-full">
                <p class="w-1/2">Created by: {{ $cause->owner()->first()->name ?? 'Not found' }}</p>

                {{-- Hashtags --}}
                <div class="flex flex-col items-end flex-grow">
                    <x-input-label for="hashtag" :value="__('Add or remove #HashTags (seperate by spaces)')" />
                    <x-text-input id="hashtag" class="block w-full mt-1" type="text" autofocus
                        autocomplete="hashtag" />
                    <x-input-error :messages="$errors->get('hashtag')" class="mt-2" />
                    <div id="tag-container" class="flex flex-wrap gap-2 my-2 text-white">
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
                        @foreach ($cause->getHashTags() as $hashtag)
                            input.value = "{{ $hashtag }}".slice(1);
                            input.dispatchEvent(new KeyboardEvent('keyup', {
                                code: "Space"
                            }))
                        @endforeach
                    </script>
                    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
                    <link rel="stylesheet" href="/resources/demos/style.css">
                    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
                    <script>
                        $(function() {
                            var availableTags = [
                                @foreach ($hashtags as $hashtag)
                                    "{{ $hashtag->hashtag }}",
                                @endforeach
                            ];
                            $("#hashtag").autocomplete({
                                source: availableTags
                            });
                        });
                    </script>
                </div>
            </div>

            <hr>
            <p>Created: {{ explode(' ', $cause->created_at)[0] }}</p>
            <hr>

            {{-- Description --}}
            <x-textarea-input name="description" :value="$cause->description" />
            <hr>

            <!-- Goal -->
            <div class="mt-4">
                <x-input-label for="goal" :value="__('Goal')" />
                <x-text-input :value="$cause->goal" step="0.1" id="goal" class="block w-full mt-1" type="number"
                    name="goal" autofocus autocomplete="goal" oninput="displayGoal(event)" />
                <x-input-error :messages="$errors->get('goal')" class="mt-2" />
                <div class="my-2">
                    <p id="goal-show"></p>
                </div>
            </div>
            <script>
                const goalContainer = document.getElementById('goal-show')
                const goalInput = document.querySelector('#goal');

                function displayGoal(event) {
                    goalContainer.innerHTML = 'Goal: $' + (+event.target.value).toLocaleString('en-US', {
                        minimumFractionDigits: 2
                    }) + ' USD';
                }
                goalInput.dispatchEvent(new Event('input'));
            </script>

            {{-- Update or delete buttons --}}
            <div class="flex justify-between">
                <x-danger-button id="open" class="ms-3">
                    {{ __('Delete') }}
                </x-danger-button>

                {{-- Approve switch --}}
                @if (auth()->user()->admin)
                    <div class="flex items-center">
                        <p class="px-2"><span id='approved'>Not approved</span><span class="hidden"
                                id='not_approved'>Approved</span></p>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input name="approved"
                                onclick="
                        const approved = document.getElementById('approved')
                        const not_approved = document.getElementById('not_approved')
                        if (approved.classList.contains('hidden')){
                            approved.classList.remove('hidden')
                            not_approved.classList.add('hidden')
                        } else {
                            approved.classList.add('hidden')
                            not_approved.classList.remove('hidden')
                        }
                        "
                                id="switch" type="checkbox" class="sr-only peer" />
                            <label name="approved" for="switch" class="hidden"></label>
                            <div
                                class="peer h-6 w-11 rounded-full border bg-slate-400 after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-slate-800 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:ring-green-300">
                            </div>
                        </label>
                @endif
                <x-primary-button class="ms-3">
                    {{ __('Update') }}
                </x-primary-button>
            </div>
        </div>
        </div>
    </form>
    <dialog id="modal" class="backdrop:bg-black backdrop:bg-opacity-80">
        <form action="{{ route('cause.destroy', $cause) }}" method="POST">
            @csrf
            <div class="flex flex-col items-center justify-center gap-4 p-8 bg-slate-700">
                <p class="text-2xl text-white">Are you sure you want to delete this post?</p>
                <div class="flex">
                    <x-primary-button class="ms-3">
                        {{ __('Delete') }}
                    </x-primary-button>
                    <x-danger-button id="close" class="ms-3">
                        {{ __('Cancel') }}
                    </x-danger-button>
                </div>
            </div>
        </form>
    </dialog>
    <script>
        const open = document.getElementById("open")
        const close = document.getElementById("close")
        const modal = document.getElementById("modal")

        open.addEventListener('click', (e) => {
            e.preventDefault();
            modal.showModal();
        })
        close.addEventListener('click', (e) => {
            e.preventDefault();
            modal.close();
        })
    </script>
</x-app-layout>
