<x-app-layout>
    <div class="py-5 pr-3">
        <section>
            <div class="relative">
                <x-text-input id="search" class="block w-full" type="search" placeholder="Пребарувај..." id="searchBrands" />
                <img src="{{ asset('images/icons/search-icon.png') }}" alt="" class="absolute w-5" id="searchIcon">
            </div>
            <div class="flex justify-end items-center space-x-2 mt-5">
                <p class="text-[#666560] font-medium"><a href="{{route('brands.create')}}">Додај нов бренд</a></p>
                <a class="bg-[#8A8328] rounded-lg p-3" href="{{route('brands.create')}}">
                    <img src="{{asset('images/icons/add-icon.png')}}" alt="" class="w-3.5">
                </a>
            </div>
        </section>
        @if (session('successAdd'))
        <div class="alert bg-[#D4EDDA] border border-green-300 p-2 rounded relative w-9/12 mx-auto mb-[-12px] mt-4 text-sm" role="alert">
            <p class="text-center text-green-950">{{ session('successAdd') }}</p>
        </div>
        @elseif(session('successUpdate'))
        <div class="alert bg-[#FFF3CD] border border-yellow-300 p-2 rounded relative w-9/12 mx-auto mb-[-12px] mt-4 text-sm font-semibold" role="alert">
            <p class="text-center text-yellow-800">{{ session('successUpdate') }}</p>
        </div>
        @endif
        <section class="mt-5">
            <div>
                <p id="searchMsg" class="hidden">No brands that include that word</p>
                @if($activeBrands->count())
                <h2 class="font-medium">Активни</h2>
                @foreach($activeBrands as $activeBrand)
                <div class="mt-3 flex justify-between border items-center rounded-md shadow-sm py-2 px-3 bg-[#FDFDFD] brandCard" data-brand="{{$activeBrand->id}}">
                    <p class="text-center text-sm font-medium">{{$activeBrand->name}}</p>
                    <div class="flex items-center justify-center space-x-1.5">
                        <a class="border rounded-full border-gray-200 cursor-pointer p-1" href="{{route('brands.edit',$activeBrand)}}">
                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                        </a>
                        <a class="border rounded-full border-gray-200 cursor-pointer p-1 deleteBrandBtns" data-brand="{{$activeBrand->id}}">
                            <i class="fa-regular fa-trash-can fa-lg"></i>
                        </a>
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-[#666560]">There are no active brands yet.Feel free to add some.</p>
                @endif
                @if($archivedBrands->count())
                <h2 class="font-medium text-[#666560] mt-5">Архива</h2>
                @foreach($archivedBrands as $archivedBrand)
                <div class="mt-3 flex justify-between border items-center rounded-md shadow-sm py-2 px-3 bg-[#FDFDFD] brandCard" data-brand="{{$archivedBrand->id}}">
                    <p class="text-center text-sm font-medium text-[#666560]">{{$archivedBrand->name}}</p>
                    <div class="flex items-center justify-center space-x-1.5">
                        <a class="border rounded-full border-gray-200 cursor-pointer p-1" href="{{route('brands.edit',$archivedBrand)}}">
                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                        </a>
                        <a class="border rounded-full border-gray-200 cursor-pointer p-1 deleteBrandBtns" data-brand="{{$archivedBrand->id}}">
                            <i class="fa-regular fa-trash-can fa-lg"></i>
                        </a>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </section>
    </div>
</x-app-layout>