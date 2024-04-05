@extends('layouts.app')

@section('content')
    @if (session('successAdd'))
        <div class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-8/12 mx-auto"
            role="alert">
            <span class="block sm:inline">{{ session('successAdd') }}</span>
        </div>
    @elseif(session('successDelete'))
        <div class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative w-8/12 mx-auto"
            role="alert">
            <span class="block sm:inline">{{ session('successDelete') }}</span>
        </div>
    @endif
    <div class="flex justify-between items-center p-3 px-3">
        <a href="{{ route('gallery.add') }}">
            <x-primary-button class="my-5">
                {{ __('Add an Image to the gallery') }}
            </x-primary-button>
        </a>
    </div>
    <div class="grid md:grid-cols-2 md:gap-2 lg:grid-cols-3 lg:gap-5 grid-cols-1">
        @foreach ($galleries as $gallery)
            <div class="max-w-sm rounded overflow-hidden shadow-lg mt-5">
                <img class="w-full" style="height: 200px;" src="{{ $gallery->images }}" alt="Gallery Image">
                <div class="px-6 pt-4 pb-2">
                    <div class="">
                        <form action="{{ route('gallery.delete', $gallery->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="bg-red-600 rounded text-white px-3 hover:bg-red-400 hover:text-black">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
