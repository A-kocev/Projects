@extends('layouts.app')

@section('content')
    <div class="sm:w-3/5 w-full mx-auto mt-6">
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

        <div class="flex justify-between items-center pt-3 px-3">
            <h2 class="font-bold pt-2 pl-2">
                All Gift Cards
            </h2>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            <a href="{{ route('gift-card.add') }}">
                <x-primary-button class="my-5">
                    {{ __('Add new Gift Card') }}
                </x-primary-button>
            </a>
        </div>
        <div class="p-3">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Card Code
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($giftCards as $giftCard)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} border-b">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $giftCard->card_code }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $giftCard->amount }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="">
                                        <x-nav-link :href="route('gift-card.edit', ['id' => $giftCard->id])" :active="request()->routeIs('gift-card.edit')"
                                            class="bg-yellow-400 px-3 mr-4 rounded text-white hover:bg-yellow-600">
                                            {{ __('Edit') }}
                                        </x-nav-link>

                                        <form action="{{ route('gift-card.delete', ['id' => $giftCard->id]) }}"
                                            class="mt-2" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="bg-red-600 rounded text-white px-3 py-1 hover:bg-red-400 hover:text-black">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
