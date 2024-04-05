@extends('layouts.app')

@section('content')
<div class="sm:w-3/4 w-full mt-6">
@if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif
    <div class="flex justify-between items-center pt-3 px-3">
        <h2 class="font-bold pt-2 pl-2">All Custom Orders</h2>
    </div>
    <div class="p-3">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Message</th>
                        <th scope="col" class="px-6 py-3">Image</th>
                        <th scope="col" class="px-6 py-3">Link</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($custom_orders as $custom_order)
                    <tr class="">
                        <td class="px-6 py-4 font-medium text-gray-900 ">
                         {{$custom_order->full_name}} 
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 ">
                        {{$custom_order->email}} 
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 ">
                        {{$custom_order->message}} 
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 ">
                          <img style="width: 50px;height:50px;" src=" {{$custom_order->image}} " alt="">
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 ">
                          <a href=" {{$custom_order->link}} "> {{$custom_order->link}} </a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="">
                                <div class="">
                                <x-nav-link :href="route('custom_order.show',$custom_order)"
                                class="bg-blue-400 px-3 mr-4 rounded text-white hover:bg-blue-600">
                                {{ __('Show') }}
                                </x-nav-link>
                                    <form class="pt-2" action="{{route('custom_order.delete',$custom_order)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-600 rounded text-white py-1 px-3 hover:bg-red-400 hover:text-black">
                                            Delete
                                        </button>
                                    </form>
                                </div>
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