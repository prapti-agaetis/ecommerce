<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <style>
        nav {
            position: sticky;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 500;
            
        }

        .search-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-bar input[type="text"] {
            padding: 6px;
            margin-right: 10px;
            border: none;
            font-size: 17px;
            border-radius: 4px;
        }

        .search-bar button {
            padding: 6px 10px;
            background: white;
            color: green;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .search-bar button:hover {
            background: darkgreen;
            color: white;
        }

        /* Responsive styling */
        @media screen and (max-width: 600px) {
            .search-bar {
                justify-content: flex-start;
                width: 100%;
                margin-top: 10px;
                padding-left: 10px;
            }

            .search-bar input[type="text"] {
                margin-right: 10px;
                width: auto;
            }

            .search-bar button {
                padding: 4px 8px;
            }
        }

        .sort-dropdown {
            display: inline-block;
            margin: 10px 0;
        }

        .sort-dropdown form {
            display: inline-block;
            margin: 0;
            padding: 0;
        }

        .sort-dropdown select {
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .sort-dropdown select:focus {
            outline: none;
            border-color: #aaa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sort-dropdown option {
            padding: 10px;
            font-size: 16px;
        }

        .sort-dropdown option:hover {
            background-color: #f0f0f0;
        }

        .sort-dropdown option:selected {
            background-color: #ccc;


        }
    </style>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">


                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}

                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                        {{ __('Cart') }}
                    </x-nav-link>

                    <x-nav-link :href="route('checkout.index')" :active="request()->routeIs('checkout.index')">
                        {{ __('Checkout') }}
                    </x-nav-link>

                    <x-nav-link :href="route('success')" :active="request()->routeIs('success')">
                        {{ __('Success') }}
                    </x-nav-link>



                 

                  


                    <!-- <form action="/products" method="get">

                        <div>
                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender">
                                <option value="">All</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                            </select>
                        </div>
             
                        <button type="submit">Filter</button>
                    </form> -->








                </div>
            </div>


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:mr-6 justify-end">
                <x-dropdown width="48">
                    <!-- dropdown content -->

                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ __('Account') }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">

                        {{-- <x-dropdown-link :href="route('admin.index')">
                {{ __('login') }}
            </x-dropdown-link> --}}

                        <x-dropdown-link :href="route('login')">
                            {{ __('login') }}
                        </x-dropdown-link>






                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>

                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        @if (Route::has('register'))
                            <x-dropdown-link :href="route('register')">
                                {{ __('Register') }}
                            </x-dropdown-link>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>



            <!-- Authentication -->

        </div>
    </div>
    </div>
</nav>
