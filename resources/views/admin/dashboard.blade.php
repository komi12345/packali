<x-admin-layout>
    {{-- Main content from original dashboard or slot for other views --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            {{ __("Bienvenue sur le tableau de bord administrateur!") }}
            <p class="mt-4">Utilisez le menu de gauche pour naviguer.</p>
        </div>
    </div>

    {{-- Example cards from the new design --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 my-8">
        <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-all border border-gray-200">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-lg">Total Products</h3>
                <span class="bg-blue-100 text-blue-800 p-2 rounded-full">
                    <span class="material-symbols-outlined">inventory_2</span>
                </span>
            </div>
            <p class="text-3xl font-bold">{{ \App\Models\PackAlimentaire::count() }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-all border border-gray-200">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-lg">Active Promotions</h3>
                <span class="bg-green-100 text-green-800 p-2 rounded-full">
                    <span class="material-symbols-outlined">local_offer</span>
                </span>
            </div>
            <p class="text-3xl font-bold">{{ \App\Models\Promotion::where('date_debut', '<=', now())->where('date_fin', '>=', now())->count() }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-all border border-gray-200">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-lg">Total Users</h3>
                <span class="bg-red-100 text-red-800 p-2 rounded-full">
                    <span class="material-symbols-outlined">group</span>
                </span>
            </div>
            <p class="text-3xl font-bold">{{ \App\Models\User::count() }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-all border border-gray-200">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-lg">Total Orders</h3>
                <span class="bg-purple-100 text-purple-800 p-2 rounded-full">
                    <span class="material-symbols-outlined">shopping_cart</span>
                </span>
            </div>
            <p class="text-3xl font-bold">{{ \App\Models\Order::count() }}</p>
        </div>
    </div>
</x-admin-layout>
