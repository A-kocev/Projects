<x-app-layout>
    <div class="py-5 pr-3">
        <section>
            <div class="relative">
                <x-text-input id="search" class="block w-full" type="search" placeholder="Пребарувај..." id="searchDiscounts" />
                <img src="{{ asset('images/icons/search-icon.png') }}" alt="" class="absolute w-5" id="searchIcon">
            </div>
            <div class="flex justify-end items-center space-x-2 mt-5">
                <p class="text-[#666560] font-medium"><a href="{{route('discounts.create')}}">Додај нов попуст/промо код</a></p>
                <a class="bg-[#8A8328] rounded-lg p-3" href="{{route('discounts.create')}}">
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
                <p id="searchMsg" class="hidden">No discounts that include that word</p>
                @if($activeDiscounts->count())
                <h2 class="font-medium">Активни</h2>
                    @foreach($activeDiscounts as $activeDiscount)
                    <div class="mt-3 flex justify-between border items-center rounded-md shadow-sm py-2 px-3 bg-[#FDFDFD] discountCard" data-discount="{{$activeDiscount->id}}">
                        <p class="text-center text-sm font-medium">{{$activeDiscount->name}}</p>
                        <div class="flex items-center justify-center space-x-1.5">
                            <a class="border rounded-full border-gray-200 cursor-pointer p-1" href="{{route('discounts.edit',$activeDiscount)}}">
                                <i class="fa-solid fa-pen-to-square fa-lg"></i>
                            </a>
                            <a class="border rounded-full border-gray-200 cursor-pointer p-1 deleteDiscountBtns" data-discount="{{$activeDiscount->id}}">
                                <i class="fa-regular fa-trash-can fa-lg"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @else
                <p class="text-[#666560]">There are no active discounts yet.Feel free to add some.</p>
                @endif
                @if($archivedDiscounts->count())
                <h2 class="font-medium text-[#666560] mt-5">Архива</h2>
                @foreach($archivedDiscounts as $archivedDiscount)
                <div class="mt-3 flex justify-between border items-center rounded-md shadow-sm py-2 px-3 bg-[#FDFDFD] discountCard" data-discount="{{$archivedDiscount->id}}">
                    <p class="text-center text-sm font-medium text-[#666560]">{{$archivedDiscount->name}}</p>
                    <div class="flex items-center justify-center space-x-1.5">
                        <a class="border rounded-full border-gray-200 cursor-pointer p-1" href="{{route('discounts.edit',$archivedDiscount)}}">
                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                        </a>
                        <a class="border rounded-full border-gray-200 cursor-pointer p-1 deleteDiscountBtns" data-discount="{{$archivedDiscount->id}}">
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