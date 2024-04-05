@extends('layouts.front-end.authentication')
@section('content')
    <h1 class="p-5">Welcome, {{Auth::user()->first_name}}  {{Auth::user()->last_name}}</h1>
    <form method="POST" action="{{ route('logout') }}"
        class="flex rounded-lg mt-2 py-2.5">
        @csrf
            <div class="border rounded-full border-gray-200 p-2 cursor-pointer"
                onclick="event.preventDefault(); this.closest('form').submit();">
                <img src="{{ asset('images/icons/log_out-icon.png') }}" alt="" class="w-5 h-5">
            </div>
            <x-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();"
                class="nav-link text-[#232221] font-semibold">
                {{ __('Одјави се') }}
            </x-nav-link>
        </form>
@endsection