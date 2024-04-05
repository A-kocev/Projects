@extends('layouts.form')
@section('content')
<form action="{{route('products.update' , $product)}}" method="POST" class="my-5" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <a href="{{route('products.index')}}">
                <img src="{{asset('images/icons/back-icon.png')}}" alt="back-icon" class="cursor-pointer">
            </a>
            <h1 class="text-lg font-semibold">Продукт</h1>
        </div>
        <select name="status" id="productStatus" class="border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm text-sm">
            <option value="" disabled>Статус</option>
            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Архивирано</option>
            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Во продажба</option>
        </select>
    </div>
    <input type="text" name="id" id="id" value="{{$product->id}}" hidden>
    <!-- name -->
    <div class="mt-8">
        <x-input-label for="name" :value="__('Име на продукт')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$product->name}}" required />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <!-- description -->
    <div class="mt-4">
        <x-input-label for="description" :value="__('Опис')" />
        <textarea name="description" id="description" class="block mt-1 w-full text-[#666560] border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm" required>{{$product->description}}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
    <!-- price -->
    <div class="mt-4">
        <x-input-label for="price" :value="__('Цена')" />
        <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" value="{{$product->price}}" required />
        <x-input-error :messages="$errors->get('price')" class="mt-2" />
    </div>
    <!-- quantity -->
    <div class="mt-4 flex items-center">
        <x-input-label for="price" :value="__('Количина:')" />
        <div class="flex justify-center items-center border text-[#666560] border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-full shadow-sm w-5 h-5 ml-3">
            <span class="text-[#504E21] mb-0.5 cursor-pointer" id="quantityMinus">&#8722;</span>
        </div>
        <input type="number" name="quantity" id="quantity" min="0" class="border-none p-1 text-center m-0 outline-none" required value="{{$product->quantity}}">
        <div class="flex justify-center items-center border text-[#666560] border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-full shadow-sm w-5 h-5">
            <span class="text-[#504E21] mb-0.5 cursor-pointer" id="quantityPlus">&#43;</span>
        </div>
    </div>
    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
    <!-- sizes -->
    <div class="flex space-x-2 mt-2 items-center">
        <x-input-label :value="__('Величина:')" />
        <div class="space-x-0.5">
            @foreach($sizes as $size)
            @php
            $isChecked = $product->sizes->contains($size->id);
            @endphp
            <label for="{{$size->name}}" class="bg-[#FFDBDB] rounded-md py-0.5 font-medium inline-block min-w-6 text-center text-sm">
                {{$size->name}}
            </label>
            <input type="checkbox" name="sizes[]" id="{{$size->name}}" value="{{$size->id}}" class="hidden" {{ $isChecked ? 'checked' : '' }}>
            @endforeach
            <div class="inline-block">
                <div class="flex justify-center items-center border text-[#666560] border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-full shadow-sm w-5 h-5" id="addSizeBtn">
                    <span class="text-[#504E21] mb-0.5 cursor-pointer">&#43;</span>
                </div>
            </div>
        </div>
    </div>
    <div id="customSizes"></div>
    <x-input-error :messages="$errors->get('sizes')" class="mt-2" />
    <!-- size hint -->
    <div class="mt-4">
        <x-input-label for="size_hint" :value="__('Совет за величина')" />
        <textarea name="size_hint" id="size_hint" class="block mt-1 w-full text-[#666560] border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm" required>{{$product->size_hint}}</textarea>
        <x-input-error :messages="$errors->get('size_hint')" class="mt-2" />
    </div>
    <!-- colors -->
    <div class="mt-4">
        <x-input-label for="size_hint" :value="__('Боја:')" class="mb-1" />
        @foreach($colors as $color)
        @php
        $isChecked = $product->colors->contains($color->id);
        @endphp
        <label class="inline-block w-6 h-6 ml-0.5 rounded-sm {{$color->name}} {{ $color->name === 'white' ? ' border border-gray-400' : '' }} {{ $isChecked && $color->name != 'black' ? 'border-2 border-black' : ''}} {{$isChecked && $color->name == 'black' ? ' border-2 border-rose-300' : ''}}" for="{{$color->name}}"></label>
        <input type="checkbox" name="colors[]" id="{{$color->name}}" class="hidden" value="{{$color->id}}" {{ $isChecked ? 'checked' : ''}}>
        @endforeach
        <x-input-error :messages="$errors->get('colors')" class="mt-2" />
    </div>

    <!-- maintenance guidlines -->
    <div class="mt-4">
        <x-input-label for="maintenance_guidelines" :value="__('Насоки за одржување:')" />
        <textarea name="maintenance_guidelines" id="maintenance_guidelines" class="block mt-1 w-full text-[#666560] border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm color-red-300" required>{{$product->maintenance_guidelines}}</textarea>
        <x-input-error :messages="$errors->get('maintenance_guidelines')" class="mt-2" />
    </div>
    <!-- tags -->
    <div class="mt-4">
        <x-input-label for="tags" :value="__('Ознаки')" />
        <input name='tags' id="tags" class='block w-full mt-1 border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm text-sm' value="{{$jsonTags}}">
        <x-input-error :messages="$errors->get('tags')" class="mt-2" />
    </div>
    <!-- images -->
    <div class="mt-4">
        <p class="text-sm mb-1 font-medium">Слики:</p>
        <div class="flex justify-between">
            <!-- main image -->
            <label for="edit_main_img" class="flex basis-2/12 justify-center items-center h-[52px] md:h-[84px] cursor-pointer text-lg">
                <img src="{{$product->images[0]->image_url}}" alt="product image" class="basis-12/12 object-cover h-full">
            </label>
            <input type="file" name="edit_main_img" id="edit_main_img" hidden class="input-image" accept="image/*">
            <!-- image 1 -->
            @if(isset($product->images[1]))
            <div class="flex flex-col basis-2/12">
                <label for="img_1" class="flex  justify-center items-center h-[52px] md:h-[84px] cursor-pointer text-lg">
                    <img src="{{$product->images[1]->image_url}}" alt="product image" class="basis-12/12 object-cover h-full">
                </label>
                <span class="text-xs text-red-600 text-center remove_img" data-product="{{$product->id}}" data-id="img_1">Remove</span>
            </div>
            @else
            <label for="img_1" class="flex basis-2/12 justify-center items-center py-3 md:py-7 bg-gray-300  cursor-pointer text-lg">
                <span class="text-[#504E21]">+</span>
            </label>
            @endif
            <input type="file" name="img_1" id="img_1" hidden class="input-image" accept="image/*">
            <!-- image 2 -->
            @if(isset($product->images[2]))
            <div class="flex flex-col basis-2/12">

                <label for="img_2" class="flex justify-center items-center h-[52px] md:h-[84px] cursor-pointer text-lg">
                    <img src="{{$product->images[2]->image_url}}" alt="product image" class="basis-12/12 object-cover h-full">
                </label>
                <span class="text-xs text-red-600 text-center remove_img" data-product="{{$product->id}}" data-id="img_2">Remove</span>
            </div>
            @else
            <label for="img_2" class="flex basis-2/12 justify-center items-center py-3 md:py-7 bg-gray-300  cursor-pointer text-lg">
                <span class="text-[#504E21]">+</span>
            </label>
            @endif

            <input type="file" name="img_2" id="img_2" hidden class="input-image" accept="image/*">
            <!-- image 3 -->
            @if(isset($product->images[3]))
            <div class="flex flex-col basis-2/12">
                <label for="img_3" class="flex justify-center items-center h-[52px] md:h-[84px] cursor-pointer text-lg">
                    <img src="{{$product->images[3]->image_url}}" alt="product image" class="basis-12/12 object-cover h-full">
                </label>
                <span class="text-xs text-red-600 text-center remove_img" data-product="{{$product->id}}" data-id="img_3">Remove</span>
            </div>
            @else
            <label for="img_3" class="flex basis-2/12 justify-center items-center py-3 md:py-7 bg-gray-300  cursor-pointer text-lg">
                <span class="text-[#504E21]">+</span>
            </label>
            @endif

            <input type="file" name="img_3" id="img_3" hidden class="input-image" accept="image/*">
        </div>
        <x-input-error :messages="$errors->get('main_img')" class="mt-2" />
    </div>
    <!-- brand and category -->
    <div class="mt-4 flex space-x-5">
        <div>
            <x-input-label for="brand" :value="__('Бренд')" />
            <select name="brand" id="edit_brand" class="inline-block mt-1 py-1.5 border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm text-sm pr-5 pl-2" required>
                <option value="" disabled selected>Одбери</option>
                @foreach($brands as $brand)
                <option value="{{$brand->id}}" {{$brand->id == $product->brand_id ? 'selected' : ''}}>{{$brand->name}}</option>
                @endforeach
            </select>
        </div>
        <div id="categoryWrapper">
            <x-input-label for="category" :value="__('Категорија')" />
            <select name="category" id="edit_category" class="inline-block mt-1 py-1.5 border-gray-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm text-sm pr-5 pl-2" required>
                <option value="" disabled selected>Одбери</option>
            </select>
        </div>
        <x-input-error :messages="$errors->get('brand')" class="mt-2" />
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>
    <!-- discount -->
    <div class="mt-4">
        <label for="discount" class="flex items-center space-x-2">
            <p class="font-medium text-[#8A8328]">Додај попуст</p>
            <div class="bg-[#8A8328] rounded-lg p-2">
                <img src="{{asset('images/icons/add-icon.png')}}" alt="" class="w-3.5 h-3.5">
            </div>
        </label>
    </div>
    <div class="mt-4 hidden" id="productDiscount">
        <select name="discount" id="discount" class="mt-1 py-1.5 border-gray-300 rounded-md shadow-sm text-sm">
            <option value="" selected>Одбери попуст</option>
            @foreach($discounts as $discount)
            <option value="{{$discount->id}}">{{$discount->name}}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('maintenance_guidelines')" class="mt-2" />
    </div>
    <!-- submit and cancel buttons -->
    <div class="mt-8 flex space-x-3 items-center">
        <x-primary-button class="basis-9/12">
            Зачувај
        </x-primary-button>
        <a class="underline" href="{{route('products.index')}}">Откажи</a>
    </div>
</form>
@endsection