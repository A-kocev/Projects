@extends('layouts.front-end.authentication')
@section('content')

<section class="pt-16 flex justify-center">
    <div>
        <x-application-logo/>
    </div>
</section>
<section class="mt-24 px-10">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email адреса')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Лозинка')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-1">
            @if (Route::has('password.request'))
            <a class="underline text-[#8A8328] text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500" href="{{ route('password.request') }}">
                {{ __('Ја заборави лозинката?') }}
            </a>
            @endif

            <x-primary-button class="block w-full  mt-4">
                {{ __('Најави се') }}
            </x-primary-button>
        </div>
    </form>
    <div>
        <p class="text-center my-7 text-[#232221]">или</p>
        <a href="/auth/google/redirect" class="flex justify-center space-x-3 items-center mt-4 border-[3px] border-[#FFDBDB] rounded-lg py-2 px-3">
            <i class="fa-brands fa-google fa-lg"></i>
            <span class="font-medium text-sm">Најави се преку Google</span>
        </a>
        <a href="/auth/facebook/redirect" class="flex justify-center space-x-3 items-center mt-4 border-[3px] border-[#FFDBDB] rounded-lg py-2 px-3">
            <i class="fa-brands fa-facebook fa-lg"></i>
            <span class="font-medium text-sm">Најави се преку Facebook</span>
        </a>
        <p class="font-medium mt-6 text-center text-sm">Немаш профил? <a href="{{route('guest.register')}}" class="text-[#8A8328] underline">Регистрирај се</a></p>
    </div>
</section>
<section class="mt-8">
    @include('layouts.footer')
</section>
@endsection