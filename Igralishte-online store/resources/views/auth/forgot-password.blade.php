<x-guest-layout>
    <section class="max-w-[80%] md:max-w-[75%] xl:-max-w-[50%] mx-auto">
    <div class="mb-4 text-sm text-gray-600">
        {{__('Си ја заборави лозинката? Никаков проблем. Само впиши ја твојата e-mail адреса и ке ти испратиме линк на кој ке можеш да си одбереш нова лозинка.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 pr-3 space-x-3">
            <x-primary-button>
                {{ __('Добиј линк') }}
            </x-primary-button>
            <a class="underline text-sm" href="{{route('guest.login')}}">Врати се назад</a>
        </div>
    </form>
    </section>
</x-guest-layout>
