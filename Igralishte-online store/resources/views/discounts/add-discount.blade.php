@extends('layouts.form')
@section('content')
<form action="{{route('discounts.store')}}" method="POST" class="flex flex-col justify-between min-h-screen py-5">
    @csrf
    <div>
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <a href="{{route('discounts.index')}}">
                    <img src="{{asset('images/icons/back-icon.png')}}" alt="back-icon" class="cursor-pointer">
                </a>
                <h1 class="text-sm font-semibold">Попуст/Промо код</h1>
            </div>
            <select name="status" id="discountStatus" class="border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm text-sm pr-5 pl-1">
                <option value="" selected disabled>Статус</option>
                <option value="0">Архивирано</option>
                <option value="1">Активно</option>
            </select>
        </div>
        <!-- name -->
        <div class="mt-8">
            <x-input-label for="name" :value="__('Име на попуст')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- percentage -->
        <div class="mt-4">
            <x-input-label for="percentage" :value="__('Попуст')" />
            <x-text-input id="percentage" class="block mt-1 w-full" type="number" min="1" max="99.99" step="0.1" name="percentage" :value="old('percentage')" required />
            <x-input-error :messages="$errors->get('percentage')" class="mt-2" />
        </div>
        <!-- brand -->
        <div class="mt-4">
            <x-input-label for="discount_brands" :value="__('Постави попуст на цел бренд')" />
            <select name="discount_brands[]" id="discount_brands" multiple>
                @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>
        </div>
        <!-- category -->
        <div class="mt-4">
            <x-input-label for="discount_categories" :value="__('Постави попуст на цела категорија')" />
            <select name="discount_categories[]" id="discount_categories" multiple>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <!-- products -->
        <div class="mt-4">
            <x-input-label for="discount_products" :value="__('Постави попуст на продукт')" />
            <select name="discount_products[]" id="discount_products" multiple>
                @foreach($products as $product)
                <option value="{{$product->id}}">{{$product->id}}-{{$product->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- submit and cancel buttons -->
    <div class="flex space-x-3 items-center">
        <x-primary-button class="basis-9/12">
            Зачувај
        </x-primary-button>
        <a class="underline" href="{{route('discounts.index')}}">Откажи</a>
    </div>
</form>
@endsection