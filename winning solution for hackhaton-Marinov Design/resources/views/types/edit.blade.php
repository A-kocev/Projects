
@extends('layouts.app')

@section('content')
<div class="sm:w-4/12 w-full sm:m-12 px-5">
<a href="{{route('types.index')}}">
    <x-primary-button class="my-5"><i class="fa-solid fa-chevron-left"></i>     {{ __('back') }}
        </x-primary-button>
    </a>
    <h1 class="text-2xl text-center">Edit Type</h1>

    {{-- Check for validation errors --}}
    @if ($errors->any())
        <div class="mb-4">
            {{-- Display list of errors --}}
        </div>
    @endif

    <form action="{{ route('types.update', $type->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Name field --}}
        <div class="mb-4">
             <x-input-label for="name" :value="__('Name')" />
             <x-text-input id="name" class="block mt-1 w-full" type="text" name="name " value="{{ old('name') }}" required  placeholder="Name of Type" value="{{ old('name') ?? $type->name }}" />
             <x-input-error :messages="$errors->get('name')" class="mt-2" />

        
        </div>

        {{-- Category ID --}}
        <div class="mb-4">
        <x-input-label for="category_id" :value="__('Category')" class="inline-block me-1" />
            <br>
            <select name="category_id" id="category_id" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $type->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Submit button --}}
        <div class="">
        <x-primary-button class="my-5">
                {{ __('Update') }}
            </x-primary-button>
            
        </div>
    </form>
</div>
@endsection
