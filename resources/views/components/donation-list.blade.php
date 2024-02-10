@props(['donations' => []])
<div {{ $attributes->merge(['class' => 'absolute w-[275px] 2xl:block hidden']) }}>
    <div class="max-w-md p-2 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Donators</h3>
        </div>
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($donations->reverse() as $donation)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{ $donation->donator->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ $donation->donator->email }}
                                </p>
                            </div>
                            <div
                                class="flex flex-col justify-start text-base font-semibold text-gray-900 dark:text-white">
                                <x-money :value="$donation->donation" />
                                <p class="text-xs text-gray-600">{{ explode(' ', $donation->created_at)[0] }}</p>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="pt-5 text-center">No donations yet...</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
