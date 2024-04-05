@extends('layouts.form')
@section('content')
<form action="{{route('brands.store')}}" method="POST" class="flex flex-col justify-between min-h-screen py-5" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <div>
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <a href="{{route('brands.index')}}">
                    <img src="{{asset('images/icons/back-icon.png')}}" alt="back-icon" class="cursor-pointer">
                </a>
                <h1 class="text-lg font-semibold">Бренд</h1>
            </div>
            <select name="status" id="status" class="border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm text-sm">
                <option value="" selected disabled>Статус</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Архивирано</option>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Активно</option>
            </select>
        </div>
        <!-- name -->
        <div class="mt-8">
            <x-input-label for="name" :value="__('Име на бренд')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Опис')" />
            <textarea name="description" id="description" class="block mt-1 w-full text-[#666560] border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm" required>{{old('description')}}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <!-- tags -->
        <div class="mt-4">
            <x-input-label for="tags" :value="__('Ознаки')" />
            <input name='tags' id="tags" class='block w-full mt-1 border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm text-sm' value="{{old('tags')}}">
            <x-input-error :messages="$errors->get('tags')" class="mt-2" />

        </div>
        <!-- images -->
        <div class="mt-4">
            <p class="text-sm mb-1 font-medium">Слики:</p>
            <div class="flex justify-between">
                <label for="main_img" class="flex basis-2/12 justify-center items-center py-3 md:py-7 bg-gray-300  cursor-pointer text-lg"><span class="text-[#504E21]">+</span></label>
                <input type="file" name="main_img" id="main_img" hidden class="input-image" accept="image/*">
                <label for="img_1" class="flex basis-2/12 justify-center items-center py-3 md:py-7 bg-gray-300  cursor-pointer text-lg"><span class="text-[#504E21]">+</span></label>
                <input type="file" name="img_1" id="img_1" hidden class="input-image" accept="image/*">
                <label for="img_2" class="flex basis-2/12 justify-center items-center py-3 md:py-7 bg-gray-300  cursor-pointer text-lg"><span class="text-[#504E21]">+</span></label>
                <input type="file" name="img_2" id="img_2" hidden class="input-image" accept="image/*">
                <label for="img_3" class="flex basis-2/12 justify-center items-center py-3 md:py-7 bg-gray-300  cursor-pointer text-lg"><span class="text-[#504E21]">+</span></label>
                <input type="file" name="img_3" id="img_3" hidden class="input-image" accept="image/*">
            </div>
            <x-input-error :messages="$errors->get('main_img')" class="mt-2" />
        </div>
        <!-- categories -->
        <div class="mt-4">
            <x-input-label for="categories" :value="__('Категории')" />
            <select name="categories[]" id="categories" multiple>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- submit and cancel buttons -->
    <div class="flex space-x-3 items-center mt-8">
        <x-primary-button class="basis-9/12">
            Зачувај
        </x-primary-button>
        <a class="underline" href="{{route('brands.index')}}">Откажи</a>
    </div>
</form>
@endsection