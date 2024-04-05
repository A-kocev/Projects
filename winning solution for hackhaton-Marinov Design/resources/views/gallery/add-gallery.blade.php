@extends('layouts.app')

@section('content')
    <div class="w-3/4 mx-auto mt-8 p-16 bg-white shadow-md">
        <form action="{{ route('gallery.store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf

            <div class="mt-4">
                <x-input-label for="images" :value="__('Images')" />

                <div class="mt-2 flex items-center">
                    <!-- <label for="images" class="cursor-pointer bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 mb-6">
                        Choose Image
                    </label> -->
                    <input type="file" name="images[]" id="images" accept="image/*" class="cursor-pointer py-2 px-4 rounded-md mb-6"  multiple />
                </div>

                <x-input-error :messages="$errors->get('images')" class="mt-2" />
            </div>

            <button type="submit" id="galleryBtn" class="bg-blue-900 text-white py-2 px-4 rounded-md hover:bg-blue-600">

                {{ 'Create Gallery' }}
            </button>
        </form>
    </div>
@endsection
