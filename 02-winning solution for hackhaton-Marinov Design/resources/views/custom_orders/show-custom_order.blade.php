@extends('layouts.app')

@section('content')


<a href="{{route('custom_order.index')}}">
    <x-primary-button class=" ml-4 my-5"><i class="fa-solid fa-chevron-left"></i>     {{ __('back') }}
        </x-primary-button>
    </a>
  
    <div class="w-3/5 mx-auto  rounded overflow-hidden shadow-lg mt-8">
                    <img class="w-full" style="height: 300px;"
                        src="{{ isset($custom_order->image) ? $custom_order->image : '' }}"
                        alt="Sunset in the mountains">
                    <div class="px-6 py-4">
                        
                        <div class="flex justify-between border-b">
                            <div>
                                <p class="text-gray-700 text-base">
                                    <span class="font-bold">Name:</span> {{$custom_order->full_name}}
                                </p>
                                <p class="text-gray-700 text-base">
                                    <span class="font-bold">Email:</span> {{$custom_order->email}}
                                </p>
                               
                                <p class="text-gray-700 text-base">
                                    <span class="font-bold">Link:</span><a href="{{$custom_order->link}}">{{$custom_order->link}}</a>
                                </p>
                            </div>
                            
                        </div>
                        <div>
                            <p class="font-bold">Description:</p>
                            <p class="text-gray-700 text-base border-b">{{$custom_order->message}}</p>
                        </div>
                        
                    </div>

                    <div class="px-6 pt-4 pb-2">

                       
                    </div>

                </div>

@endSection