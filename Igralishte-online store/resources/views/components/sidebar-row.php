@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex justify-center items-center bg-red-100 rounded-lg bg-rose-50 focus:outline-none focus:text-rose-800 focus:bg-rose-100 focus:border-rose-700 transition duration-150 ease-in-out'
            : 'flex justify-center items-center bg-red-100 rounded-lg bg-rose-50 focus:outline-none focus:text-rose-800 focus:bg-rose-100 focus:border-rose-700 transition duration-150 ease-in-out bg-primary';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>


