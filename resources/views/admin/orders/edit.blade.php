<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier la Commande') }} #{{ $order->id }}
        </h2>
    </div>

    <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                        @csrf
                        @method('PUT')

                        <!-- Client Name -->
                        <div class="mb-4">
                            <x-input-label for="client_name" :value="__('Nom du Client')" />
                            <x-text-input id="client_name" class="block mt-1 w-full" type="text" name="client_name" :value="old('client_name', $order->client_name)" required autofocus />
                            <x-input-error :messages="$errors->get('client_name')" class="mt-2" />
                        </div>

                        <!-- Client Phone -->
                        <div class="mb-4">
                            <x-input-label for="client_phone" :value="__('Numéro de Téléphone')" />
                            <x-text-input id="client_phone" class="block mt-1 w-full" type="text" name="client_phone" :value="old('client_phone', $order->client_phone)" required />
                            <x-input-error :messages="$errors->get('client_phone')" class="mt-2" />
                        </div>

                        <!-- Delivery Address -->
                        <div class="mb-4">
                            <x-input-label for="delivery_address" :value="__('Lieu de Livraison')" />
                            <textarea id="delivery_address" name="delivery_address" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('delivery_address', $order->delivery_address) }}</textarea>
                            <x-input-error :messages="$errors->get('delivery_address')" class="mt-2" />
                        </div>

                        <!-- Order Date -->
                        <div class="mb-4">
                            <x-input-label for="order_date" :value="__('Date de la Commande')" />
                            <x-text-input id="order_date" class="block mt-1 w-full" type="date" name="order_date" :value="old('order_date', $order->order_date)" required />
                            <x-input-error :messages="$errors->get('order_date')" class="mt-2" />
                        </div>

                        <!-- Pack Alimentaires -->
                        <div class="mb-4">
                            <x-input-label for="pack_alimentaires" :value="__('Packs Alimentaires Commandés')" />
                            <select name="pack_alimentaires[]" id="pack_alimentaires" multiple class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm h-40">
                                @php
                                    $selectedAlimentaires = old('pack_alimentaires', $order->packAlimentaires->pluck('id')->toArray());
                                @endphp
                                @foreach ($packAlimentaires as $pack)
                                    <option value="{{ $pack->id }}" {{ in_array($pack->id, $selectedAlimentaires) ? 'selected' : '' }}>
                                        {{ $pack->nom }} ({{ number_format($pack->prix, 0, ',', ' ') }} FCFA)
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('pack_alimentaires')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __('Maintenez la touche Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs packs.') }}</p>
                        </div>

                        <!-- Pack Scolaires -->
                        <div class="mb-4">
                            <x-input-label for="pack_scolaires" :value="__('Packs Scolaires Commandés')" />
                            <select name="pack_scolaires[]" id="pack_scolaires" multiple class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm h-40">
                                @php
                                    $selectedScolaires = old('pack_scolaires', $order->packScolaires->pluck('id')->toArray());
                                @endphp
                                @foreach ($packScolaires as $pack)
                                    <option value="{{ $pack->id }}" {{ in_array($pack->id, $selectedScolaires) ? 'selected' : '' }}>
                                        {{ $pack->nom }} ({{ number_format($pack->prix, 0, ',', ' ') }} FCFA)
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('pack_scolaires')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __('Maintenez la touche Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs packs.') }}</p>
                        </div>
                        
                        <!-- Total Price (This will be calculated, consider making it read-only or calculated via JS) -->
                        <div class="mb-4">
                            <x-input-label for="total_price" :value="__('Prix Total (calculé automatiquement)')" />
                            <x-text-input id="total_price" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700" type="number" name="total_price" :value="old('total_price', $order->total_price)" readonly />
                            <x-input-error :messages="$errors->get('total_price')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Statut de la Livraison')" />
                            <select name="status" id="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="pas encore livré" {{ old('status', $order->status) == 'pas encore livré' ? 'selected' : '' }}>{{ __('Pas encore livré') }}</option>
                                <option value="livré" {{ old('status', $order->status) == 'livré' ? 'selected' : '' }}>{{ __('Livré') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.orders.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                {{ __('Annuler') }}
                            </a>

                            <x-primary-button>
                                {{ __('Mettre à Jour la Commande') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const packAlimentairesSelect = document.getElementById('pack_alimentaires');
            const packScolairesSelect = document.getElementById('pack_scolaires');
            const totalPriceInput = document.getElementById('total_price');
            const packAlimentairesPrices = JSON.parse('@json($packAlimentaires->pluck('prix', 'id'))');
            const packScolairesPrices = JSON.parse('@json($packScolaires->pluck('prix', 'id'))');

            function calculateTotalPrice() {
                let total = 0;
                
                // Calculer le total des packs alimentaires
                const selectedAlimentaires = Array.from(packAlimentairesSelect.selectedOptions);
                selectedAlimentaires.forEach(option => {
                    total += parseFloat(packAlimentairesPrices[option.value]);
                });
                
                // Calculer le total des packs scolaires
                const selectedScolaires = Array.from(packScolairesSelect.selectedOptions);
                selectedScolaires.forEach(option => {
                    total += parseFloat(packScolairesPrices[option.value]);
                });
                
                totalPriceInput.value = total.toFixed(0);
            }

            packAlimentairesSelect.addEventListener('change', calculateTotalPrice);
            packScolairesSelect.addEventListener('change', calculateTotalPrice);
            calculateTotalPrice(); // Initial calculation
        });
    </script>
    @endpush
</x-admin-layout>