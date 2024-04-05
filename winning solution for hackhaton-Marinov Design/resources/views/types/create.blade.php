@extends('layouts.app')

@section('content')
<div class="sm:w-4/12 w-full sm:m-12 px-5">
<a href="{{route('types.index')}}">
    <x-primary-button class="my-5"><i class="fa-solid fa-chevron-left"></i>     {{ __('back') }}
        </x-primary-button>
    </a>
    <h1 class="text-2xl text-center">Add New Type</h1>
    <form action="{{ route('types.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name " value="{{ old('name') }}" required  placeholder="Name of Type" />
         <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

       
        <div class="mb-4">
        <x-input-label for="category_id" :value="__('Category')" class="inline-block me-1" />
            <br>
            <select name="category_id" id="category_id" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value=""selected disabled>Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            @error('category_id')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
        <x-primary-button class="my-5">
                {{ __('Add') }}
            </x-primary-button>
        </div>
    </form>
</div>
@endsection
