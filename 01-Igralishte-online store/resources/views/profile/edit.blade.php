<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    @if(session('successUpdate'))
    <div class="alert bg-[#FFF3CD] border border-yellow-300 p-2 rounded relative w-12/12 mx-4 mb-[-12px] mt-4 text-sm font-semibold" role="alert">
        <p class="text-center text-yellow-800">{{ session('successUpdate') }}</p>
    </div>
    @endif
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white ">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>