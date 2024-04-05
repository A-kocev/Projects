@extends('layouts.app')

@section('content')
    <div class="sm:w-3/4 w-full mt-6">
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
            <h2 class="font-bold pt-2 pl-2">All Maintenances</h2>
            <a href="{{ route('gift-card.add') }}">
                <x-primary-button class="my-5">
                    {{ __('Add new Maintenance') }}
                </x-primary-button>
            </a>
        </div>
        <div class="p-3">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maintenances as $maintenance)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} order-b">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $maintenance->title }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $maintenance->description }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="">
                                        <div class="">


                                            <x-nav-link :href="route('maintenances.edit', $maintenance->id)"
                                                class="py-1 bg-yellow-400 px-3 mr-4 rounded text-white hover:bg-yellow-600">
                                                {{ __('Edit') }}
                                            </x-nav-link>


                                            <form action="{{ route('maintenances.delete', $maintenance->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="py-1 bg-red-600 rounded text-white px-3 hover:bg-red-400 hover:text-black">
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