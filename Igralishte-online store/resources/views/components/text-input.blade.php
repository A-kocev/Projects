@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-[#666560] border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-lg shadow-sm']) !!}>
