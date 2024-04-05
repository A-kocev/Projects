@extends('layouts.app')

@section('content')
<div class="sm:w-4/12 w-full px-5 sm:m-12">
<a href="{{route('faq.index')}}">
    <x-primary-button class="my-5"><i class="fa-solid fa-chevron-left"></i>     {{ __('back') }}
        </x-primary-button>
    </a>
    <h1 class="text-2xl text-center">Edit FAQ</h1>
    <form action="{{ route('faq.update', ['id' => $faq->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Question -->
        <div class="mt-4">
            <x-input-label for="question" :value="__('Question')" />
            <x-text-input id="question" class="block mt-1 w-full" type="text" name="question" :value="$faq->question" required />
            <x-input-error :messages="$errors->get('question')" class="mt-2" />
        </div>

        <!-- Answer -->
        <div class="mt-4">
            <x-input-label for="answer" :value="__('Answer')" />
            <textarea id="answer" name="answer" rows="4" class="block mt-1 w-full" required>{{ $faq->answer }}</textarea>
            <x-input-error :messages="$errors->get('answer')" class="mt-2" />
        </div>

        <x-primary-button class="my-5">
            {{ __('Update') }}
        </x-primary-button>
    </form>
</div>
@endsection