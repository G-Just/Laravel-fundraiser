@props([
    'collected' => 'Failed to load, contact admin',
    'goal' => 'Failed to load, contact admin',
])

<div class="flex w-full gap-2 mt-4 lg:w-2/3">
    <x-money :value="$collected" />
    <div class="flex w-full border border-gray-500">
        <div class="w-[{{ round(((int) $collected * 100) / $goal) }}%] bg-indigo-600"></div>
    </div>
    <x-money :value="$goal" />
</div>
