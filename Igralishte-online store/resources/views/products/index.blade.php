<x-app-layout>
    <div class="min-h-screen flex flex-col py-5">
        <section class="flex">
            <div class="relative basis-8/12">
                <form action="" id="searchProcutsForm">
                    @csrf
                    <x-text-input id="search" class="block w-full" type="search" name="searchProducts" placeholder="Пребарувај..." id="searchProducts" />
                    <img src="{{ asset('images/icons/search-icon.png') }}" alt="" class="absolute w-5" id="searchIcon">
                </form>
            </div>
            <div class="basis-4/12 flex justify-center items-center space-x-2">
                <input type="radio" class="hidden" name="viewOptions" id="tableView" checked />
                <label for="tableView">
                    <div class="border rounded-lg border-gray-200 p-2 cursor-pointer" id="tableViewIcon">
                        <img src="{{asset('images/icons/table_view-icon.png')}}" alt="" class="w-4">
                    </div>
                </label>
                <input type="radio" class="hidden" name="viewOptions" id="listView" />
                <label for="listView">
                    <div class="border rounded-lg border-gray-200 p-2 cursor-pointer" id="listViewIcon">
                        <img src="{{asset('images/icons/list_view-icon.png')}}" alt="" class="w-4">
                    </div>
                </label>
            </div>
        </section>
        <section class="pr-3 mt-5">
            <div class="flex justify-end items-center space-x-2">
                <p class="text-[#666560] font-medium"><a href="{{route('products.create')}}">Додај нов продукт</a></p>
                <a class="bg-[#8A8328] rounded-lg p-3" href="{{route('products.create')}}">
                    <img src="{{asset('images/icons/add-icon.png')}}" alt="" class="w-3.5">
                </a>
            </div>
            @if (session('successAdd'))
            <div class="alert bg-[#D4EDDA] border border-green-300 p-2 rounded relative w-9/12 mx-auto mb-[-12px] mt-4 text-sm" role="alert">
                <p class="text-center text-green-950">{{ session('successAdd') }}</p>
            </div>
            @elseif(session('successUpdate'))
            <div class="alert bg-[#FFF3CD] border border-yellow-300 p-2 rounded relative w-9/12 mx-auto mb-[-12px] mt-4 text-sm font-semibold" role="alert">
                <p class="text-center text-yellow-800">{{ session('successUpdate') }}</p>
            </div>
            @endif
            <div class="mt-8">
                @if(!$products->total() && isset($value))
                <div class="flex flex-col items-center p-5">
                    <p class="text-[#666560]">There are no products whose name contains "{{$value}}".</p>
                    <x-secondary-button class="mt-3">
                        Show all products
                    </x-secondary-button>
                </div>
                @elseif(!$products->total())
                <p class="text-[#666560]">There are no products yet.Feel free to add some.</p>
                @else
                @if(isset($value) && $products->currentPage() == 1 )
                <p class="text-[#666560]">Showing products whose name contains "{{$value}}".</p>
                @endif
                <div class="md:flex md:flex-wrap">
                    @foreach($products as $product)
                    <div class="md:basis-6/12 lg:basis-4/12 md:pl-5 py-3">
                        <div class="listCard mt-3 flex border items-center rounded-md shadow-sm py-2 px-1 bg-[#FDFDFD]" data-product="{{$product->id}}">
                            <p class="basis-2/12 text-center font-bold text-[#8A8328]">{{$product->id}}</p>
                            <p class="basis-7/12 text-center text-xs font-medium">{{$product->name}}</p>
                            <div class="basis-3/12 flex items-center justify-center space-x-1.5">
                                <a class="border rounded-full border-gray-200 cursor-pointer p-1" href="{{route('products.edit',$product)}}">
                                    <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                </a>
                                <a class="border rounded-full border-gray-200 cursor-pointer p-1 deleteProductBtns" data-product="{{$product->id}}">
                                    <i class="fa-regular fa-trash-can fa-lg"></i>
                                </a>
                            </div>
                        </div>
                        <div class="tableCard mt-3 border rounded-md shadow-sm p-3 bg-[#FDFDFD]" data-product="{{$product->id}}">
                            @if($product->quantity == 0)
                            <p class="font-jost">Продадено</p>
                            @elseif($product->quantity == 1)
                            <div class="flex justify-between">
                                <p class="font-cormorant">само 1 парче</p>
                                <p class="font-cormorant">{{$product->status ? 'Во продажба' : 'Архивирано'}}</p>
                            </div>
                            @else
                            <div class="flex justify-between">
                                <p class="font-cormorant">{{$product->quantity}} парчиња</p>
                                <p class="font-cormorant">{{$product->status ? 'Во продажба' : 'Архивирано'}}</p>
                            </div>
                            @endif
                            <div class="slider-outer mt-2">
                                <div class="slider-inner">
                                    @if(count($product->images) > 1)
                                    <i class="fa-solid fa-chevron-left fa-xl prev"></i>
                                    <i class="fa-solid fa-chevron-right fa-xl next"></i>
                                    @endif
                                    <div class="h-[250px]">
                                        @foreach($product->images as $image)
                                        <img src="{{$image->image_url}}" alt="" class="w-full h-full rounded-lg object-cover {{ $loop->first ? 'active' : '' }}">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between mt-2 items-center">
                                <h2 class="font-cormorant text-2xl basis-10/12">{{$product->name}}</h2>
                                <span class="text-[#8A8328]">{{$product->id}}</span>
                            </div>
                            <div class="mt-2 text-[#666560] flex items-center space-x-1 font-medium">
                                <span class="font-cormorant text-lg">Боја:</span>
                                @foreach($product->colors as $color)
                                <span class="inline-block w-3 h-3 rounded-sm {{$color->name}} {{ $color->name === 'white' ? 'border border-gray-400' : '' }}"></span>
                                @endforeach
                            </div>
                            <div class="flex justify-between font-medium">
                                <div>
                                    <span class="text-[#666560] font-cormorant text-lg">Величина:</span>
                                    @foreach($product->sizes as $size)
                                    <span class="font-cormorant text-lg">{{$size->name}}</span>@unless($loop->last), @endunless
                                    @endforeach
                                </div>
                                <div>
                                    <span class="text-[#666560] font-cormorant text-lg">Цена:</span>
                                    <span class="font-cormorant text-lg">{{$product->price}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>

                @endif
            </div>
        </section>
        <section class="mt-auto">
            @if(isset($value) && $products->currentPage() == $products->lastPage() && $products->total())
            <div class="text-center p-5">
                <p class="text-[#666560]">Showed {{$products->total()}}/{{$products->total()}} products whose name contains "{{$value}}".</p>
                <x-secondary-button class="mt-3">
                    Show all products
                </x-secondary-button>
            </div>
            @endif
            <div class="mt-5">{{$products->links()}}</div>
        </section>
    </div>
</x-app-layout>