@extends('layouts.app')

@section('content')
    <div class="w-5/12 m-12">
    <a href="{{route('products.index')}}">
    <x-primary-button class="my-5"><i class="fa-solid fa-chevron-left"></i>     {{ __('back') }}
        </x-primary-button>
    </a>
        <h1 class="text-2xl text-center ">Edit product</h1>
        <form action="{{ route('product.update') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            <input type="number" name="id" id="id" hidden value="{{ $product->id }}">
            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="edit_title" :value="__('Title')" />
                <x-text-input id="edit_title" class="block mt-1 w-full" type="text" name="title" :value="$product->title"
                    required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <!-- Category and type -->
            <div class="mt-4">
                <x-input-label for="edit_categories" :value="__('Category')" class="inline-block me-1" />
                <select name="categories" id="edit_categories"
                    class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="" selected disabled>Choose a category</option>
                    @foreach ($categories as $category)
                        @if ($category->id == $product->category_id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
                <select name="types" id="edit_types"
                    class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </select>
                <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                <x-input-error :messages="$errors->get('types')" class="mt-2" />
            </div>
            <!-- Materials-->
            <div class="mt-4">
                <x-input-label :value="__('Materials')" />
                @foreach ($materials as $material)
                    @php
                        $checked = false;
                        foreach ($product->materials as $productMaterial) {
                            if ($productMaterial->id == $material->id) {
                                $checked = true;
                                break;
                            }
                        }
                    @endphp
                    <label for="{{ $material->id }}" class="font-medium text-sm text-gray-700 dark:text-gray-300">
                        {{ $material->name }}
                    </label>
                    <input type="checkbox" name="materials[]" id="{{ $material->id }}" value="{{ $material->id }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm me-2"
                        @if ($checked) checked @endif>
                @endforeach
                <x-input-error :messages="$errors->get('materials')" class="mt-2" />
            </div>

            <!-- maintenances -->
            <div class="mt-4">
                <x-input-label :value="__('Maintenances')" />

                @foreach ($maintenances as $maintenance)
                    @php
                        $checkedMaintenance = false;
                        foreach ($product->maintenances as $productMaintenance) {
                            if ($productMaintenance->id == $maintenance->id) {
                                $checkedMaintenance = true;
                                break;
                            }
                        }
                    @endphp

                    <label for="{{ $maintenance->id }}" class="font-medium text-sm text-gray-700 dark:text-gray-300">
                        {{ $maintenance->title }}
                    </label>

                    <input type="checkbox" name="maintenances[]" id="{{ $maintenance->id }}"
                        value="{{ $maintenance->id }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm me-2"
                        @if ($checkedMaintenance) checked @endif>
                @endforeach

                <x-input-error :messages="$errors->get('maintenances')" class="mt-2" />
            </div>
            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="edit_desc" :value="__('Description')" />
                <textarea name="desc" id="edit_desc"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $product->description }}</textarea>
                <x-input-error :messages="$errors->get('desc')" class="mt-2" />
            </div>
            <!-- Price -->
            <div class="mt-4">
                <x-input-label for="price" :value="__('Price')" />
                <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="$product->price"
                    min="0.5" step="0.01" required />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>
            <!-- Quantity -->
            <div class="mt-4">
                <x-input-label for="edit_quantity" :value="__('Quantity')" />
                <x-text-input id="edit_quantity" class="block mt-1 w-full" type="number" name="quantity" :value="$product->quantity"
                    min="0" required />
                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
            </div>
            <!-- weight -->
            <div class="mt-4">
                <x-input-label for="edit_weight" :value="__('Weight')" />
                <x-text-input id="edit_weight" class="block mt-1 w-full" type="text" name="weight" :value="$product->weight"
                    required />
                <x-input-error :messages="$errors->get('weight')" class="mt-2" />
            </div>
            <!-- Dimensions -->
            <div class="mt-4">
                <x-input-label for="edit_edit_dimensions" :value="__('Dimensions')" />
                <x-text-input id="edit_edit_dimensions" class="block mt-1 w-full" type="text" name="dimensions"
                    :value="$product->dimensions" required />
                <x-input-error :messages="$errors->get('dimensions')" class="mt-2" />
            </div>
            <!-- Images -->
            <div class="mt-4">
                <label for="main_img" class="font-medium text-sm text-gray-700 dark:text-gray-300 mt-2 block">Main
                    Image</label>
                <img src="{{ $mainImage->image_url }}" alt="product_image" class="w-2/12">

                <input type="file" name="main_img" id="main_img" value="{{ $mainImage->iamge_url }}">
                <x-input-error :messages="$errors->get('main_img')" class="mt-2" />
                <label for="img_1" class="font-medium text-sm text-gray-700 dark:text-gray-300 mt-2 block">Image
                    1</label>

                @if (isset($images[1]))
                    <img src="{{ $images[1]->image_url ?? '' }}" alt="product_image" class="w-2/12">
                @endif
                <input type="file" name="img_1" id="img_1">
                <label for="img_2" class="font-medium text-sm text-gray-700 dark:text-gray-300 mt-2 block">Image
                    2</label>

                @if (isset($images[2]))
                    <img src="{{ $images[2]->image_url ?? '' }}" alt="product_image" class="w-2/12">
                @endif
                <input type="file" name="img_2" id="img_2">
                <label for="img_3" class="font-medium text-sm text-gray-700 dark:text-gray-300 mt-2 block">Image
                    3</label>
                @if (isset($images[3]))
                    <img src="{{ $images[3]->image_url ?? '' }}" alt="product_image" class="w-2/12">
                @endif
                <input type="file" name="img_3" id="img_3">
            </div>
            <!-- Featured -->
            <div class="mt-4">
                <x-input-label for="is_featured" :value="__('Featured')" class="inline-block me-3" />
                @if ($product->is_featured)
                    <x-text-input id="is_featured" class="inline-block" type="checkbox" name="is_featured" checked
                        value="1" />
                @else
                    <x-text-input id="is_featured" class="inline-block" type="checkbox" name="is_featured"
                        value="1" />
                @endif
            </div>
            <!-- Discount -->
            <div class="mt-4">
                <x-input-label for="edit_discount" :value="__('Discount')" />
                <x-text-input id="edit_discount" class="block mt-1 w-full" type="number" name="discount"
                    min="1" :value="$product->discount" />
            </div>
            <x-primary-button class="my-5">
                {{ __('Update') }}
            </x-primary-button>

        </form>
    </div>
@endsection
