@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="sm:w-4/12 w-full p-8 sm:m-12">
            <a href="{{ route('discounts.index') }}">
                <x-primary-button class="my-5"><i class="fa-solid fa-chevron-left mr-1"></i>
                    {{ __('back') }}</x-primary-button>
            </a>
            <h1 class="text-xl font-semibold mb-5">Edit Discount</h1>
            <form action="{{ route('discounts.update', $discount->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="discount_code">Discount Code</label>
                    <input type="text" name="discount_code" id="discount_code"
                        value="{{ old('discount_code', $discount->discount_code) }}" class="form-input mt-1 block w-full"
                        required>
                </div>
                <div class="mb-4">
                    <label for="percentage">Percentage (%)</label>
                    <input type="number" name="percentage" id="percentage"
                        value="{{ old('percentage', $discount->percentage) }}" class="form-input mt-1 block w-full"
                        required>
                </div>
                <x-primary-button class="my-5">
                    Update Discount
                </x-primary-button>
            </form>
        </div>
    </div>
@endsection
