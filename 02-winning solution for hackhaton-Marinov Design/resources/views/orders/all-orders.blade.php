@extends('layouts.app')

@section('content')
    <div class=" w-full mt-6">
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
            <h2 class="font-bold pt-2 pl-2">All Orders</h2>
           
        </div>
        <div class="p-3">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Country</th>
                            <th scope="col" class="px-6 py-3">City</th>
                            <th scope="col" class="px-6 py-3">Zip code</th>
                            <th scope="col" class="px-6 py-3">Address</th>
                            <th scope="col" class="px-6 py-3">Disscount</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} order-b">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                   {{$order->full_name}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$order->email}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$order->country}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$order->city}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$order->zip_code}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$order->address}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$order->discount_code}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$order->status}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$order->total_amount}}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="">
                                    <x-nav-link :href="route('orders.show', $order->id)"
                                                class="py-1 bg-blue-400 px-3 mr-4 rounded text-white hover:bg-blue-600">
                                                {{ __('show') }}
                                            </x-nav-link>
                                     
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