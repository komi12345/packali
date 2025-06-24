<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la Promotion') }}
        </h2>
    </div>

    <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Pack Alimentaire</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $promotion->packAlimentaire->nom ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Prix Promotionnel</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $promotion->prix_promotionnel }} €</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Date de Début</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $promotion->date_debut }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Date de Fin</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $promotion->date_fin }}</p>
                        </div>
                    </div>

                    @if ($promotion->packAlimentaire && $promotion->packAlimentaire->image)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Image du Pack</h3>
                            <img src="{{ asset('storage/' . $promotion->packAlimentaire->image) }}" alt="{{ $promotion->packAlimentaire->nom }}" class="mt-2 rounded-lg shadow-md max-h-60">
                        </div>
                    @endif

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('admin.promotions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Retour à la liste
                        </a>
                        <a href="{{ route('admin.promotions.edit', $promotion) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Modifier
                        </a>
                        <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette promotion?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</x-admin-layout>