@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-2.5 pt-1 text-[15px] font-semibold leading-6 text-[
#232221]'
: 'inline-flex items-center px-2.5 pt-1 text-[15px] font-semibold leading-6 text-gray-600';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>