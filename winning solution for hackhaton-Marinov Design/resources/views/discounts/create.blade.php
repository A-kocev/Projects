@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="sm:w-4/12 w-full p-8 sm:m-12">
        <a href="{{ route('discounts.index') }}">
            <x-primary-button class="my-5"><i class="fa-solid fa-chevron-left mr-1"></i> {{ __('back') }}</x-primary-button>
        </a>
        <h1 class="text-xl font-semibold mb-5">Add New Discount</h1>
        <form action="{{ route('discounts.store') }}" method="POST" >
            @csrf
            <div class="mb-4">
                <label for="discount_code">Discount Code</label>
                <input type="text" name="discount_code" id="discount_code" value="{{ $code }}"
                    class="form-input mt-1 block w-full" required disabled>
            </div>
            <div class="mb-4">
                <label for="percentage">Percentage (%)</label>
                <input type="number" name="percentage" id="percentage" class="form-input mt-1 block w-full" required>
            </div>
            <x-primary-button class="my-5">
                Add Discount
            </x-primary-button>
        </form>
    </div>
    </div>
@endsection
