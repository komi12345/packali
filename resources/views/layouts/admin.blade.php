<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme', Auth::user()?->theme ?: 'light') === 'dark' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <style>
            .material-symbols-outlined {
              font-variation-settings:
              'FILL' 0,
              'wght' 400,
              'GRAD' 0,
              'opsz' 24
            }
        </style>
        <div class="min-h-screen bg-gray-100 flex flex-col">
            <!-- Admin Navigation -->
            <div x-data="{
                    sidebarOpen: false,
                    searchQuery: '',
                    searchResults: { packs: [], clients: [] },
                    searchLoading: false,
                    searchModalOpen: false,
                    performSearch() {
                        if (this.searchQuery.length < 2) { // Minimum 2 caractères pour rechercher
                            this.searchResults = { packs: [], clients: [] };
                            this.searchModalOpen = false;
                            return;
                        }
                        this.searchLoading = true;
                        fetch(`{{ route('admin.search') }}?query=${this.searchQuery}`, {
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest' // Important pour que $request->wantsJson() fonctionne
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            this.searchResults = data;
                            this.searchLoading = false;
                            this.searchModalOpen = true;
                        })
                        .catch(error => {
                            console.error('Error fetching search results:', error);
                            this.searchLoading = false;
                            this.searchModalOpen = false; // Ou afficher un message d'erreur dans le modal
                        });
                    },
                    closeSearchModal() {
                        this.searchModalOpen = false;
                        // Ne pas vider searchQuery ici pour que l'utilisateur puisse continuer à taper ou modifier
                    }
                 }"
                 class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col flex-grow">
                <div class="flex items-center justify-between bg-indigo-600 text-white p-6">
                    <div class="flex items-center">
                        <!-- Hamburger Button -->
                        <button @click="sidebarOpen = !sidebarOpen" class="text-white mr-4 md:hidden">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <h1 class="text-2xl font-bold">{{ __('Admin Dashboard') }}</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative sm:block" @click.away="closeSearchModal()">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="material-symbols-outlined">search</span>
                            </span>
                            <input type="text"
                                   x-model="searchQuery"
                                   @input.debounce.500ms="performSearch()"
                                   @focus="if(searchQuery.length >= 2) searchModalOpen = true"
                                   class="pl-10 pr-4 py-2 bg-indigo-700 text-white placeholder-indigo-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-300 transition-all w-full sm:w-auto"
                                   placeholder="Rechercher..." />
                            
                            <!-- Search Modal -->
                            <div x-show="searchModalOpen && searchQuery.length >=2"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute mt-2 w-full sm:w-96 max-h-96 overflow-y-auto bg-indigo-900 rounded-md shadow-lg z-50 text-indigo-100 border border-indigo-700"
                                 style="display: none;"> <!-- display:none pour éviter le flash au chargement initial -->
                                
                                <div x-show="searchLoading" class="p-4 text-center">
                                    <span class="italic text-indigo-300">Chargement...</span>
                                </div>

                                <div x-show="!searchLoading && searchResults.packs.length === 0 && searchResults.clients.length === 0 && searchQuery.length >= 2" class="p-4 text-center">
                                    <span class="italic text-indigo-300">Aucun résultat pour "<span x-text="searchQuery"></span>"</span>
                                </div>

                                <div x-show="!searchLoading && (searchResults.packs.length > 0 || searchResults.clients.length > 0)">
                                    <div x-show="searchResults.packs.length > 0">
                                        <h4 class="px-4 pt-3 pb-1 text-xs font-semibold text-indigo-300 uppercase tracking-wider">Packs Alimentaires</h4>
                                        <ul>
                                            <template x-for="pack in searchResults.packs" :key="pack.id">
                                                <li>
                                                    <a :href="pack.url" @click="closeSearchModal()" class="block px-4 py-2 hover:bg-indigo-800 transition-colors">
                                                        <p x-text="pack.nom" class="font-medium text-indigo-100"></p>
                                                        <p x-text="pack.description ? pack.description.substring(0, 50) + (pack.description.length > 50 ? '...' : '') : ''" class="text-sm text-indigo-300"></p>
                                                    </a>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                    <div x-show="searchResults.clients.length > 0">
                                        <h4 class="px-4 pt-3 pb-1 text-xs font-semibold text-indigo-300 uppercase tracking-wider">Clients</h4>
                                        <ul>
                                            <template x-for="client in searchResults.clients" :key="client.id">
                                                <li>
                                                    <a :href="client.url" @click="closeSearchModal()" class="block px-4 py-2 hover:bg-indigo-800 transition-colors">
                                                        <p x-text="client.name" class="font-medium text-indigo-100"></p>
                                                        <p x-text="client.client_phone ? client.client_phone : (client.email ? client.email : '')" class="text-sm text-indigo-300"></p>
                                                    </a>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                </div>
                                <div class="p-2 text-center border-t border-indigo-800" x-show="!searchLoading && (searchResults.packs.length > 0 || searchResults.clients.length > 0)">
                                     <a :href="`{{ route('admin.search') }}?query=${searchQuery}`" @click="closeSearchModal()" class="text-sm text-indigo-300 hover:underline">Voir tous les résultats</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center bg-indigo-700 rounded-full p-2 cursor-pointer hover:bg-indigo-800 transition-all">
                            <span class="material-symbols-outlined">notifications</span>
                        </div>
                        <div x-data="{ open: false }" class="relative">
                            <div @click="open = !open" class="flex items-center space-x-2 cursor-pointer">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full border-2 border-indigo-300"/>
                                <span class="font-medium">{{ Auth::user()->name }}</span>
                                @if(Auth::user()->is_super_admin)
                                    <span class="text-xs bg-yellow-500 text-yellow-900 px-2 py-1 rounded-full">Super Admin</span>
                                @else
                                    <span class="text-xs bg-blue-500 text-blue-900 px-2 py-1 rounded-full">Admin</span>
                                @endif
                                <span class="material-symbols-outlined" :class="{'rotate-180': open}">expand_more</span>
                            </div>

                            <!-- Dropdown Menu -->
                            <div x-show="open"
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); this.closest('form').submit();"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex relative flex-grow">
                    <!-- Overlay for mobile when sidebar is open -->
                    <div x-show="sidebarOpen"
                         @click="sidebarOpen = false"
                         x-transition:enter="transition-opacity ease-linear duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition-opacity ease-linear duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden">
                    </div>

                    <!-- Sidebar -->
                    <div :class="{'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen}"
                         class="fixed inset-y-0 left-0 z-40 w-64 bg-gray-800 text-white transform transition-transform duration-300 md:relative md:translate-x-0 flex flex-col">
                        <div class="p-4 flex-grow overflow-y-auto">
                            <div class="flex justify-between items-center md:hidden mb-4">
                                <span class="text-xl font-semibold">Menu</span>
                                <button @click="sidebarOpen = false" class="text-gray-400 hover:text-white">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-4 p-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : 'hover:bg-gray-700' }} mb-6">
                                <span class="material-symbols-outlined">dashboard</span>
                                <span class="font-medium">Dashboard</span>
                            </a>
                            <div class="space-y-2">
                                <a href="{{ route('admin.packs.index') }}" class="flex items-center space-x-4 p-3 rounded-lg {{ request()->routeIs('admin.packs.*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }} cursor-pointer transition-all">
                                    <span class="material-symbols-outlined">restaurant_menu</span>
                                    <span class="font-medium">Produits</span>
                                </a>
                                <a href="{{ route('admin.promotions.index') }}" class="flex items-center space-x-4 p-3 rounded-lg {{ request()->routeIs('admin.promotions.*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }} cursor-pointer transition-all">
                                    <span class="material-symbols-outlined">local_offer</span>
                                    <span class="font-medium">Promotions</span>
                                </a>
                                <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-4 p-3 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }} cursor-pointer transition-all">
                                    <span class="material-symbols-outlined">receipt_long</span>
                                    <span class="font-medium">Commandes</span>
                                </a>
                                <a href="{{ route('admin.clients.index') }}" class="flex items-center space-x-4 p-3 rounded-lg {{ request()->routeIs('admin.clients.*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }} cursor-pointer transition-all">
                                    <span class="material-symbols-outlined">people</span>
                                    <span class="font-medium">Clients</span>
                                </a>
                                <a href="{{ route('admin.analytics.index') }}" class="flex items-center space-x-4 p-3 rounded-lg {{ request()->routeIs('admin.analytics.*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }} cursor-pointer transition-all">
                                    <span class="material-symbols-outlined">insights</span>
                                    <span class="font-medium">Statistiques</span>
                                </a>
                                @if(Auth::user()->is_super_admin)
                                <a href="{{ route('admin.settings.index') }}" class="flex items-center space-x-4 p-3 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-600' : 'hover:bg-gray-700' }} cursor-pointer transition-all">
                                    <span class="material-symbols-outlined">settings</span>
                                    <span class="font-medium">Paramètres</span>
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="mt-auto p-4 border-t border-gray-700">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-700 cursor-pointer transition-all">
                                    <span class="material-symbols-outlined">logout</span>
                                    <span class="font-medium">{{ __('Log Out') }}</span>
                                </a>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Main Content -->
                    <div class="flex-1 p-6 overflow-auto">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
