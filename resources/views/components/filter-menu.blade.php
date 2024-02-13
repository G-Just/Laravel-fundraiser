@props(['hashtags' => DB::table('hashtags')->get()])
<div class="border rounded-lg lg:max-h-64 bg-slate-800 border-slate-700">
    <form action="{{ route('home') }}">
        <div class="flex flex-col items-start justify-between gap-4 p-4 lg:items-end lg:flex-row">
            <div class="flex justify-start gap-8">
                <div>
                    <x-input-label class="my-2" for="sort" :value="'Sort'" />
                    <select class="bg-slate-800" name="sort" id="sort">
                        <option value="" disabled hidden selected>Sort by ...</option>
                        <option {{ app('request')->query('sort') == 'DESC' ? 'selected' : '' }} value="DESC">Likes
                            &darr;</option>
                        <option {{ app('request')->query('sort') == 'ASC' ? 'selected' : '' }} value="ASC">Likes
                            &uarr;</option>
                    </select>
                </div>
                <div>
                    <x-input-label class="my-2" for="filter" :value="'Filter'" />
                    <select class="bg-slate-800" name="filter" id="filter">
                        <option value="" disabled hidden {{ old('filter') == '' ? 'selected' : '' }}>Filter by ...
                        </option>
                        @foreach ($hashtags as $hashtag)
                            <option {{ app('request')->query('filter') == $hashtag->hashtag ? 'selected' : '' }}
                                value="{{ $hashtag->hashtag }}">
                                #{{ $hashtag->hashtag }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-end gap-2">
                <x-primary-button>{{ __('Apply') }}</x-primary-button>
                <a href="{{ route('home', ['page' => request()->page]) }}">Reset</a>
            </div>
        </div>
    </form>
</div>
