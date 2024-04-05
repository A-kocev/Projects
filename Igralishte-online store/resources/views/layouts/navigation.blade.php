<nav class="min-h-screen flex flex-col justify-between items-center p-5">
    <div class="flex flex-col items-center">
        <div>
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="rounded-full overflow-hidden w-[52px] h-[52px] openMenu hover:cursor-pointer">
                        <img src="{{ Auth::user()->image_url }}" alt="profile image" class="w-full h-full object-cover">
                    </div>
                    <div class="hidden nav-link">
                        <h3 class="font-semibold text-[#1A1B2D] capitalize">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h3>
                        <p class="text-sm">{{Auth::user()->email}}</p>
                    </div>
                </div>
                <div class="hidden nav-link">
                    <img src="{{ asset('images/icons/close-icon.png') }}" alt="" id="closeMenuBtn" class="cursor-pointer">
                </div>
            </div>
            <div class="flex justify-center items-center rounded-lg mt-6 py-2.5 sidebar-links {{ request()->routeIs('products.index') ? 'bg-[#FFDBDB]' : '' }}">
                <div>
                    <img src="{{ asset('images/icons/material-symbols_filter-vintage.png') }}" alt="" class="w-6 h-6 openMenu hover:cursor-pointer">
                </div>
                <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" class="hidden nav-link">
                    {{ __('Vintage Облека') }}
                </x-nav-link>
            </div>
            <div class="flex justify-center items-center rounded-lg mt-2 py-2.5 sidebar-links {{ request()->routeIs('discounts.index') ? 'bg-[#FFDBDB]' : '' }}">
                <div>
                    <img src="{{ asset('images/icons/discounts-icon.png') }}" alt="" class="w-6 h-6 openMenu hover:cursor-pointer">
                </div>
                <x-nav-link :href="route('discounts.index')" :active="request()->routeIs('discounts.index')" class="hidden nav-link">
                    {{ __('Попусти / промо') }}
                </x-nav-link>
            </div>
            <div class="flex justify-center items-center rounded-lg mt-2 py-2.5 sidebar-links {{ request()->routeIs('brands.index') ? 'bg-[#FFDBDB]' : '' }}">
                <div>
                    <img src="{{ asset('images/icons/brands-icon.png') }}" alt="" class="w-5 h-5 openMenu hover:cursor-pointer biggerIcons">
                </div>
                <x-nav-link :href="route('brands.index')" :active="request()->routeIs('brands.index')" class="hidden nav-link pl-3">
                    {{ __('Брендови') }}
                </x-nav-link>
            </div>
            <div class="flex justify-center items-center rounded-lg mt-2 py-2.5 sidebar-links {{ request()->routeIs('profile.edit') ? 'bg-[#FFDBDB]' : '' }}">
                <div>
                    <img src="{{ asset('images/icons/profile-icon.png') }}" alt="" class="w-5 h-5 openMenu hover:cursor-pointer biggerIcons">
                </div>
                <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="hidden nav-link pl-3">
                    {{ __('Профил') }}
                </x-nav-link>
            </div>
        </div>
    </div>
    <div class="flex">
        <form method="POST" action="{{ route('logout') }}" class="flex justify-center items-center rounded-lg mt-2 py-2.5">
            @csrf
            <div class="border rounded-full border-gray-200 p-2 cursor-pointer" onclick="event.preventDefault(); this.closest('form').submit();">
                <img src="{{ asset('images/icons/log_out-icon.png') }}" alt="" class="w-5 h-5">
            </div>
            <x-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();" class="hidden nav-link text-[#232221] font-semibold">
                {{ __('Одјави се') }}
            </x-nav-link>
        </form>
    </div>
</nav>