@extends('layouts.app')

@section('content')
<div class="sm:w-4/12 w-full px-5 sm:m-12">
    <a href="{{ route('gift-card.index') }}">
        <x-primary-button class="my-5"><i class="fa-solid fa-chevron-left"></i> {{ __('Back') }}</x-primary-button>
    </a>
    <h1 class="text-2xl text-center">Edit Gift Card</h1>
    <form action="{{ route('gift-card.update', ['id' => $giftCard->id]) }}" method="POST">
        @csrf
        @method('put')

        <!-- Card Code -->
        <div class="mt-4">
            <x-input-label for="card_code" :value="__('Card Code')" />
            <x-text-input id="card_code" class="block mt-1 w-full" type="text" name="card_code" :value="$giftCard->card_code" required />
            <x-input-error :messages="$errors->get('card_code')" class="mt-2" />
        </div>

        <!-- Amount -->
        <div class="mt-4">
            <x-input-label for="amount" :value="__('Amount')" />
            <x-text-input id="amount" class="block mt-1 w-full" type="text" name="amount" :value="$giftCard->amount" required />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>

        <x-primary-button class="my-5">
            {{ __('Update') }}
        </x-primary-button>
    </form>
</div>

@endsection
