@extends('layouts.app')

@section('content')
    <div class="w-3/4 mx-auto mt-8 p-16 bg-white shadow-md">
    <a href="{{route('maintenances.add')}}">
    <x-primary-button class="my-5"><i class="fa-solid fa-chevron-left"></i>     {{ __('back') }}
        </x-primary-button>
    </a>
        @if (isset($maintenance))
            <h1 class="text-2xl font-bold mb-6">Edit Maintenance</h1>
            <form id="maintenanceForm" data-maintenance-id="{{ $maintenance->id }}"
                action="{{ route('maintenances.update', $maintenance->id) }}" method="POST">
                @csrf
                @method('PUT')
            @else
                <h1 class="text-2xl font-bold mb-6">Create Maintenance</h1>
                <form id="maintenanceForm" action="{{ route('maintenances.store') }}" method="POST">
                    @csrf
        @endif

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-600">Title:</label>
            <input type="text" name="title" id="title" class="mt-1 p-2 border border-gray-300 rounded-md w-full"
                value="{{ isset($maintenance) ? $maintenance->title : '' }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-600">Description:</label>
            <textarea name="description" id="description" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>{{ isset($maintenance) ? $maintenance->description : '' }}</textarea>
        </div>

        <button type="submit" id="maintenanceBtn" class="bg-blue-900 text-white py-2 px-4 rounded-md hover:bg-blue-600">
            {{ isset($maintenance) ? 'Update Maintenance' : 'Create Maintenance' }}
        </button>
        
        </form>
    </div>
@endsection
