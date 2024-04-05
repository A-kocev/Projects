@extends('layouts.front-end.authentication')
@section('content')
<section class="pt-16 flex justify-center">
    <div>
        <x-application-logo />
    </div>
</section>
<section class="mt-12 px-3">
    <form method="POST" action="{{route('register')}}" class="space-y-4" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        <!-- image -->
        <div class="flex flex-col items-center">
            <div id="imgWrapper" class="w-[140px] h-[140px] rounded-full overflow-hidden hidden"></div>
            <label class="bg-[#E2E2E2] py-0.5 px-3 rounded-full font-century mt-4" for="image_url">Одбери слика</label>
            <input type="file" name="image_url" id="image_url" hidden accept="image/*">
        </div>
        <!-- address -->
        <div>
            <x-input-label for="address" :value="__('Адреса')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>
        <!-- phone number -->
        <div>
            <x-input-label for="phone_number" :value="__('Телефонски број')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="number" name="phone_number" :value="old('phone_number')" autocomplete="phone_number" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>
        <!-- Bio -->
        <div>
            <x-input-label for="bio" :value="__('Биографија')" />
            <textarea name="bio" id="bio" class="block mt-1 w-full text-[#666560] border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm"></textarea>
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="block w-[75%]" type="submit">
                {{ __('Заврши') }}
            </x-primary-button>
        </div>
        <p class="underline mt-4" id="submitParagraph">Прескокни</p>
    </form>
</section>

@endsection