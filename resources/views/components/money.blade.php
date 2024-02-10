@props(['value'])

<p {{ $attributes->merge(['class' => '']) }}><span class="mr-0.5">$</span>{{ number_format((float) $value, 2) ?? $slot }}
</p>
