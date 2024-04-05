<nav x-data="{ open: false }" class="bg-primary-white">
    <div class="bg-primary-white flex justify-between px-4 pb-2 mt-2 items-center border-b drop-shadow-md">

        <div class="shrink-0 flex items-center">

            <a href="{{ route('dashboard') }}">

                <x-admin-logotype class=" block h-9  fill-current text-gray-800  w-6" />

            </a>

        </div>

        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500  bg-white  hover:text-gray-700  focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    @if(Auth::user()->role_id === 1)
                    <x-dropdown-link :href="route('register')">
                        {{ __('Register') }}
                    </x-dropdown-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
        <div class="-me-2 flex items-center sm:hidden">
            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400  hover:text-gray-500 hover:bg-gray-100  focus:outline-none focus:bg-gray-100  focus:text-gray-500  transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

                        @if(Auth::user()->role_id === 1)
                        <x-dropdown-link :href="route('register')">
                            {{ __('Register') }}
                        </x-dropdown-link>
                        @endif
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex pt-5">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
    </div>
    <div id="nav_products" class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex  pt-3">
        <x-nav-link>
            {{ __('Products') }} <i class=" pl-2 fa-solid fa-chevron-down text-xs"></i>
        </x-nav-link>

    </div>
    <div id="product_items" class=" hidden bg-white w-3/4 rounded-md  pt-2 ">
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex  hover:underline-black">
            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                {{ __('All Product') }}
            </x-nav-link>

        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex   pt-2">
            <x-nav-link :href="route('types.index')" :active="request()->routeIs('types.index')">
                {{ __('All Types') }}
            </x-nav-link>

        </div>

        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex  pt-2 ">
            <x-nav-link :href="route('materials.index')" :active="request()->routeIs('materials.index')">
                {{ __('All Materials') }}
            </x-nav-link>

        </div>

        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex   pt-2">
            <x-nav-link :href="route('maintenances.index')" :active="request()->routeIs('maintenances.index')">
                {{ __('All Maintenance') }}
            </x-nav-link>

        </div>


    </div>
    <div id="nav_orders" class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex pt-3">
        <x-nav-link>
            {{ __('Orders') }} <i class=" pl-2 fa-solid fa-chevron-down text-xs"></i>
        </x-nav-link>
    </div>
    <div id="orders_items" class="hidden bg-white w-3/4 rounded-md pt-2">
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex  hover:underline-black">
            <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                {{ __('All Orders') }}
            </x-nav-link>
        </div>
    </div>

    <div id="nav_gallery" class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex pt-3">
        <x-nav-link>
            {{ __('Gallery') }} <i class=" pl-2 fa-solid fa-chevron-down text-xs"></i>
        </x-nav-link>
    </div>
    <div id="gallery_items" class="hidden bg-white w-3/4 rounded-md pt-2">
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex  hover:underline-black">
            <x-nav-link :href="route('gallery.index')" :active="request()->routeIs('gallery.index')">
                {{ __('Full Gallery') }}
            </x-nav-link>
        </div>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex  hover:underline-black pt-3">
        <x-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.index')">
            {{ __('All FAQ') }}
        </x-nav-link>
    </div>
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex  hover:underline-black pt-3">
        <x-nav-link :href="route('gift-card.index')" :active="request()->routeIs('gift-card.index')">
            {{ __('Gift Cards') }}
        </x-nav-link>
    </div>
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex  hover:underline-black pt-3">
        <x-nav-link :href="route('discounts.index')" :active="request()->routeIs('discounts.index')">
            {{ __('Discount Cupones') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex  hover:underline-black pt-3">
        <x-nav-link :href="route('custom_order.index')" :active="request()->routeIs('custom_order.index')">
            {{ __('Custom Made Orders') }}
        </x-nav-link>
    </div>

         <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
        <div id="nav_responsive_products" class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link>
                {{ __('Products') }} <i class=" pl-2 fa-solid fa-chevron-down text-xs"></i>
            </x-responsive-nav-link>
        </div>
        <div id="product_responsive_items" class="hidden">
            <div class=" ">
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                    {{ __('All Products') }}
                </x-responsive-nav-link>
            </div>
            <div class=" ">
                <x-responsive-nav-link :href="route('types.index')" :active="request()->routeIs('types.index')">
                    {{ __('All Types') }}
                </x-responsive-nav-link>
            </div>
            <div class=" ">
                <x-responsive-nav-link :href="route('materials.index')" :active="request()->routeIs('materials.index')">
                    {{ __('All Materials') }}
                </x-responsive-nav-link>
            </div>
            <div class=" ">
                <x-responsive-nav-link :href="route('maintenances.index')" :active="request()->routeIs('maintenances.index')">
                    {{ __('All Maintenance') }}
                </x-responsive-nav-link>
            </div>
        </div>
        <div id="nav_responsive_orders" class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link>
                {{ __('Orders') }} <i class=" pl-2 fa-solid fa-chevron-down text-xs"></i>
            </x-responsive-nav-link>
        </div>
        <div id="orders_responsive_items" class="hidden">
            <div class=" ">
                <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                    {{ __('All Orders') }}
                </x-responsive-nav-link>
            </div>
        </div>

        <div class=" ">
            <x-responsive-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.index')">
                 {{ __('All FAQ') }} 
            </x-responsive-nav-link>
        </div>
        <div class=" ">
            <x-responsive-nav-link :href="route('gift-card.index')" :active="request()->routeIs('gift-card.index')">
                 {{ __('Gift Cards') }} 
            </x-responsive-nav-link>
        </div>
        <div class=" ">
            <x-responsive-nav-link :href="route('discounts.index')" :active="request()->routeIs('discounts.index')">
                 {{ __('Discount Cupones') }} 
            </x-responsive-nav-link>
        </div>
        
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Custom Made Orders') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 ">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 ">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                @if(Auth::user()->role_id === 1)
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                    @endif
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
