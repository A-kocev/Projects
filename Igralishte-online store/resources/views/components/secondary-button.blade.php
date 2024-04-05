<button {{ $attributes->merge(['type' => 'button', 'class' => ' text-white inline-flex items-center p-2 bg-[#8A8328] rounded-md text-sm shadow-sm']) }} onclick="window.location.href='/products'">
    {{ $slot }}
</button>
