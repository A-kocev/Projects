@extends('layouts.app')

@section('content')
<div class="w-5/12 m-12">

    <a href="{{route('products.index')}}">
    <x-primary-button class="my-5"><i class="fa-solid fa-chevron-left"></i>     {{ __('back') }}
        </x-primary-button>
    </a>

    <h1 class="text-2xl text-center ">Add new product</h1>
    <form action="{{route('product.store')}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <!-- Category and type -->
        <div class="mt-4">
            <x-input-label for="categories" :value="__('Category')" class="inline-block me-1" />
            <select name="categories" id="categories"
                class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" selected disabled>Choose a category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <select name="types" id="types" style="display:none;" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            </select>
            <x-input-error :messages="$errors->get('categories')" class="mt-2" />
            <x-input-error :messages="$errors->get('types')" class="mt-2" />
        </div>
        <div class="mt-4">
            <!-- Materials-->
        <x-input-label :value="__('Materials')" />
        @foreach($materials as $material)
        <label for="{{$material->id}}" class="font-medium text-sm text-gray-700 dark:text-gray-300">{{$material->name}}</label>
        <input type="checkbox" name="materials[]" id="{{$material->id}}" value="{{$material->id}}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm me-2">
        @endforeach
        <x-input-error :messages="$errors->get('materials')" class="mt-2" />
        </div>
        <!-- maintenances -->
        <div class="mt-4">
        <x-input-label :value="__('Maintenances')" />
        @foreach($maintenances as $maintenance)
        <label for="{{$maintenance->id}}" class="font-medium text-sm text-gray-700 dark:text-gray-300">{{$maintenance->title}}</label>
        <input type="checkbox" name="maintenances[]" id="{{$maintenance->id}}" value="{{$maintenance->id}}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm me-2">
        @endforeach
        <x-input-error :messages="$errors->get('maintenances')" class="mt-2" />
        </div>
        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="desc" :value="__('Description')" />
            <textarea name="desc" id="desc"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{old('desc')}}</textarea>
            <x-input-error :messages="$errors->get('desc')" class="mt-2" />
        </div>
        <!-- Price -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')"
                min="0.5" step="0.5" required />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>
        <!-- Quantity -->
        <div class="mt-4">
            <x-input-label for="quantity" :value="__('Quantity')" />
            <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity')"
                min="0" required />
            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
        </div>
        <!-- weight -->
        <div class="mt-4">
            <x-input-label for="weight" :value="__('Weight')" />
            <x-text-input id="weight" class="block mt-1 w-full" type="text" name="weight" :value="old('weight')"
                required />
            <x-input-error :messages="$errors->get('weight')" class="mt-2" />
        </div>
        <!-- Dimensions -->
        <div class="mt-4">
            <x-input-label for="dimensions" :value="__('Dimensions')" />
            <x-text-input id="dimensions" class="block mt-1 w-full" type="text" name="dimensions"
                :value="old('dimensions')" required />
            <x-input-error :messages="$errors->get('dimensions')" class="mt-2" />
        </div>
        <!-- Images -->
        <div class="mt-4">
            <x-input-label for="main_img" :value="__('Main Image')" class="mt-2" />
            <input type="file" name="main_img" id="main_img" >
            <x-input-error :messages="$errors->get('main_img')" class="mt-2" />
            <x-input-label for="img_1" :value="__('Image 1')" class="mt-2" />
            <input type="file" name="img_1" id="img_1" >
            <x-input-label for="img_2" :value="__('Image 2')" class="mt-2" />
            <input type="file" name="img_2" id="img_2" >
            <x-input-label for="img_3" :value="__('Image 3')" class="mt-2" />
            <input type="file" name="img_3" id="img_3" >
        </div>
        <!-- Featured -->
        <div class="mt-4">
            <x-input-label for="is_featured" :value="__('Featured')" class="inline-block me-3" />
            <x-text-input id="is_featured" class="inline-block" type="checkbox" name="is_featured" checked value="1" />
        </div>
        <!-- Discount -->
        <div class="mt-4">
            <x-input-label for="discount" :value="__('Discount')" />
            <x-text-input id="discount" class="block mt-1 w-full" type="number" name="discount" min="1" />
        </div>
        <x-primary-button class="my-5">
            {{ __('Add') }}
        </x-primary-button>

    </form>
 
</div>

@endsection