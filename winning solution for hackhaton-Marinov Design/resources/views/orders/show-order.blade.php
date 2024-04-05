@extends('layouts.app')

@section('content')
    <div class=" w-full mt-6">
      
        <div class="flex justify-between items-center pt-3 px-3">
            <h2 class="font-bold pt-2 pl-2">Order {{$orders->id}}</h2>
           
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
                       
                    <tr class=" order-b">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$orders->full_name}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$orders->email}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$orders->country}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$orders->city}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$orders->zip_code}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$orders->address}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$orders->discount_code}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$orders->status}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$orders->total_amount}}
                                </td>
                            </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>

<div class="flex justify-between items-center pt-3 px-3">
            <h2 class="font-bold pt-2 pl-2">Products</h2>
           
        </div>
        <div class="p-3">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">price</th>
                            <th scope="col" class="px-6 py-3">Quantity</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($orders->products as $product)
                    <tr class=" order-b">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$product->title}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$product->description}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$product->price}}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$product->pivot->quantity}}
                                </td>
                             
                            </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection