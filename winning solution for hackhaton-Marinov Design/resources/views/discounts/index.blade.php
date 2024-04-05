@extends('layouts.app')

@section('content')
    <div class="sm:w-3/5 w-full mx-auto mt-6">
        <h1 class="text-xl font-semibold mb-5">Discounts</h1>
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
        <a href="{{ route('discounts.create') }}">
            <x-primary-button class="my-5">
                {{ __('Add new Coupon') }}
            </x-primary-button>
        </a>
        <div class="">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="p-4">Discount Code</th>
                            <th scope="col">Percentage (%)</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discounts as $discount)
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900 ">
                                    {{ $discount->discount_code }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 ">
                                    {{ $discount->percentage }}</td>
                                <td class="pr-6 py-4">
                                    <div class="">
                                        <div class="">
                                            <a href="{{ route('discounts.edit', $discount->id) }}"
                                                class="bg-yellow-400 px-3 py-1 mr-2 rounded text-white hover:bg-yellow-600">
                                                Edit</a>
                                            <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST"
                                                class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600 inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
