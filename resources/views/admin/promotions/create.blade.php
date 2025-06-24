<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter une Promotion') }}
        </h2>
    </div>

    <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.promotions.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="pack_alimentaire_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pack Alimentaire</label>
                                <select id="pack_alimentaire_id" name="pack_alimentaire_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:text-gray-200">
                                    @foreach($packsAlimentaires as $pack)
                                        <option value="{{ $pack->id }}" {{ old('pack_alimentaire_id') == $pack->id ? 'selected' : '' }}>{{ $pack->nom }}</option>
                                    @endforeach
                                </select>
                                @error('pack_alimentaire_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="prix_promotionnel" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prix Promotionnel (€)</label>
                                <input type="number" name="prix_promotionnel" id="prix_promotionnel" value="{{ old('prix_promotionnel') }}" step="0.01" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200">
                                @error('prix_promotionnel')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="date_debut" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de Début</label>
                                <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200">
                                @error('date_debut')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="date_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de Fin</label>
                                <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200">
                                @error('date_fin')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('admin.promotions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Annuler
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Ajouter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</x-admin-layout>