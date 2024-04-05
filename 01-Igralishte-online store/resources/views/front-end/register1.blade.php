@extends('layouts.front-end.authentication')
@section('content')


<section class="pt-16 flex justify-center">
    <div>
        <x-application-logo />
    </div>
</section>
<section class="mt-12 px-3">
    <form method="GET" action="{{ route('guest.register2') }}">
        @csrf
        <!-- first name -->
        <div>
            <x-input-label for="first_name" :value="__('Име')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>
        <!-- last name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Презиме')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email адреса')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Лозинка')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" value="{{$user->password}}" required />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- confirm password -->
        <div class="mt-4">
            <x-input-label for="update_password_password_confirmation" :value="__('Повтори лозинка')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="mt-4">
            <input type="checkbox" name="wants_notifications" id="wants_notifications" class="hidden" {{ old('wants_notifications') ? 'checked' : '' }} value="1">
            <div class="flex items-center">
                <label class="relative mr-2" for="wants_notifications">
                    <img src="{{ asset('images/icons/circle-check.png') }}" alt="check-icon" id="circle_icon">
                    <img src="{{ asset('images/icons/check-icon.png') }}" alt="check-icon" class="{{ old('wants_notifications') ? '' : 'hidden' }} absolute" id="check_icon">
                </label>
                <label for="wants_notifications" class="text-xs inline-block ">Испраќај ми известувања за нови зделки и промоции</label>
            </div>
        </div>
        <div class="mt-1">
            <x-primary-button class="block w-full  mt-4">
                {{ __('Регистрирај се') }}
            </x-primary-button>
        </div>
    </form>
</section>
<footer class="pb-5 mt-8">
    <p class="text-xs">Со вашата регистрација, се согласувате со <span class="font-medium underline">Правилата и Условите</span> за кориснички сајтови.</p>
</footer>
@endsection