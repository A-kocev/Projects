<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-[#232221] border border-transparent rounded-lg font-bold text-sm text-white tracking-widest']) }}>
    {{ $slot }}
</button>