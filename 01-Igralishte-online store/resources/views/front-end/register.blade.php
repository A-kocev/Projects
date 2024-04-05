@extends('layouts.front-end.authentication')
@section('content')

<section class="pt-16 flex justify-center">
    <div>
        <x-application-logo />
    </div>
</section>
<section class="mt-24 px-10">
    @if(session('error'))
    <div class="alert bg-[#f8d7da] border border-red-300 p-2 rounded relative w-9/12 mx-auto my-4 text-sm" role="alert">
        <p class="text-center text-red-800">{{ session('error') }}</p>
    </div>
    @endif
    <form method="GET" action="{{ route('guest.register1') }}">
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
            <x-primary-button class="block w-full  mt-4">
                {{ __('Регистрирај се') }}
            </x-primary-button>
        </div>
    </form>
    <div>
        <p class="text-center my-7 text-[#232221]">или</p>
        <a href="/auth/google/redirect" class="flex justify-center space-x-3 items-center mt-4 border-[3px] border-[#FFDBDB] rounded-lg py-2 px-3">
            <i class="fa-brands fa-google fa-lg"></i>
            <span class="font-medium text-sm">Регистрирај се преку Google</span>
        </a>
        <a href="/auth/facebook/redirect" class="flex justify-center space-x-2 items-center mt-4 border-[3px] border-[#FFDBDB] rounded-lg p-2">
            <i class="fa-brands fa-facebook fa-lg"></i>
            <span class="font-medium text-sm">Регистрирај се преку Facebook</span>
        </a>
        <p class="font-medium mt-6 text-center text-sm">Веќе имаш профил? <a href="{{route('guest.login')}}" class="text-[#8A8328] underline">Логирај се</a></p>
    </div>
</section>
<section class="mt-8">
    @include('layouts.footer')
</section>
@endsection