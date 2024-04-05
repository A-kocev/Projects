@extends('layouts.app')

@section('content')
    <div class=" p-3">
        <form action=""method="" class="w-auto sm:flex justify-between mb-10 mt-3">
            @csrf
            <x-text-input id="search" class="block w-1/2" type="text" name="search" :value="old('search')" autofocus
                autocomplete="search" placeholder="Search" />
            <div>
                <select name="category" id="category">
                    <option value="">Select Chategory</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <select name="type" id="type">
                    <option value="">Select Type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach

                </select>
                <x-primary-button class="">
                    {{ __('Search') }}
                </x-primary-button>
            </div>

        </form>
        <div class=" flex justify-between items-center pt-3 px-3">
            <h2 class="font-bold pt-2 pl-2 text-xl">
                All Products
            </h2>

            <a href="{{ route('product.create') }}">
                <x-primary-button class="my-5">
                    {{ __('Add a Product') }}
                </x-primary-button>
            </a>
        </div>

        @if (session('successAdd'))
            <div class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-8/12 mx-auto"
                role="alert">
                <span class="block sm:inline">{{ session('successAdd') }}</span>
            </div>
        @elseif(session('successEdit'))
            <div class="alert bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative w-8/12 mx-auto"
                role="alert">
                <span class="block sm:inline">{{ session('successEdit') }}</span>
            </div>
        @elseif(session('successDelete'))
            <div class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative w-8/12 mx-auto"
                role="alert">
                <span class="block sm:inline">{{ session('successDelete') }}</span>
            </div>
        @endif

        <div class="grid  md:grid-cols-2 md:gap-2 lg:grid-cols-3  lg:gap-5 grid-cols-1">
            @foreach ($products as $product)
                <div class="max-w-sm rounded overflow-hidden shadow-lg mt-5">
                    <img class="w-full" style="height: 200px;"
                        src="{{ isset($product->images[0]) ? $product->images[0]->image_url : '' }}"
                        alt="Sunset in the mountains">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2 border-b">{{ $product->title }}</div>
                        <div class="flex justify-between border-b">
                            <div>
                                <p class="text-gray-700 text-base">
                                    <span class="font-bold">Price:</span>&euro;{{ $product->price }}
                                </p>
                                <p class="text-gray-700 text-base">
                                    <span class="font-bold">Discount:</span>{{ $product->discount }}%
                                </p>
                                <p class="text-gray-700 text-base">
                                    <span class="font-bold">Category:</span>{{ $product->category->name }}
                                </p>
                                <p class="text-gray-700 text-base">
                                    <span class="font-bold">Type:</span>{{ $product->type->name }}
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-700 text-base">
                                    <span class="font-bold">Weight:</span>{{ $product->weight }}g
                                </p>
                                <p class="text-gray-700 text-base">
                                    <span class="font-bold">Dimensions:</span>{{ $product->dimensions }}
                                </p>
                                <p class="text-gray-700 text-base">
                                    <span class="font-bold">Materials:</span>
                                    @foreach ($product->materials as $materials)
                                        {{ $materials->name }}
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div>
                            <p class="font-bold">Description:</p>
                            <p class="text-gray-700 text-base border-b">{{ $product->description }}</p>
                        </div>
                        <div>
                            <p class="font-bold">Maintenance:</p>
                            @foreach ($product->maintenances as $maintenance)
                                <p class="font-bold">{{ $maintenance->title }}:</p>
                                <p class="text-gray-700 text-base border-b">
                                    {{ $maintenance->description }}
                                </p>
                            @endforeach
                        </div>
                    </div>

                    <div class="px-6 pt-4 pb-2">

                        <div class=" w-1/2 mx-auto flex">
                            <x-nav-link :href="route('product.edit', $product->id)"
                                class="bg-yellow-400 px-3 mr-4 rounded text-white hover:bg-yellow-600">
                                {{ __('Edit') }}
                            </x-nav-link>
                            <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <Button
                                    class="bg-red-600 rounded text-white px-3 hover:bg-red-400 hover:text-black">Delete</Button>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>


    </div>

    {{ $products->links() }}
@endsection
