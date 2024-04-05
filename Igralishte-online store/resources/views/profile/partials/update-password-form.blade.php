@extends('layouts.form')
@section('content')
<section class="py-5">
    <header>
        <div class="flex items-center space-x-3">
            <a href="{{route('profile.update')}}">
                <img src="{{asset('images/icons/back-icon.png')}}" alt="back-icon" class="cursor-pointer">
            </a>
            <h2 class="text-lg font-medium">
                {{ __('Промени лозинка') }}
            </h2>
        </div>

        <p class="mt-3 text-sm text-[#666560]">
            Размислете за долга и комплексна лозинка, која е тешка за предвидување. Избегнувајте очекувани информации или лични детали. Вашата безбедност е важна!
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Сегашна лозника')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password"  required/>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Нова лозинка')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" required />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Повтори лозинка')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" required />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-8 flex space-x-3 items-center">
            <x-primary-button class="basis-9/12">
                Зачувај
            </x-primary-button>
            <a class="underline" href="{{route('profile.update')}}">Откажи</a>
        </div>
    </form>
</section>
@endsection