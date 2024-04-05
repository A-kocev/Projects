@extends('layouts.app')

@section('content')
<div class="sm:w-4/12 w-full px-5 sm:m-12">
<a href="{{route('materials.index')}}">
    <x-primary-button class="my-5"><i class="fa-solid fa-chevron-left"></i>     {{ __('back') }}
        </x-primary-button>
    </a>
    <h1 class="text-2xl text-center">Edit Material</h1>
    <form action="{{ route('materials.update', ['id' => $material->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name of Material')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$material->name" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <x-primary-button class="my-5">
            {{ __('Update') }}
        </x-primary-button>

    </form>
</div>
@endsection