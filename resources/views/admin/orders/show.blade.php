<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la Commande') }} #{{ $order->id }}
        </h2>
    </div>

    <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">{{ __('Informations Client') }}</h3>
                            <p><strong>{{ __('Nom:') }}</strong> {{ $order->client_name }}</p>
                            <p><strong>{{ __('Téléphone:') }}</strong> {{ $order->client_phone }}</p>
                            <p><strong>{{ __('Adresse de Livraison:') }}</strong> {{ $order->delivery_address }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">{{ __('Informations Commande') }}</h3>
                            <p><strong>{{ __('Date de Commande:') }}</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</p>
                            <p><strong>{{ __('Prix Total:') }}</strong> {{ number_format($order->total_price, 0, ',', ' ') }} FCFA</p>
                            <p><strong>{{ __('Statut:') }}</strong> 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $order->status === 'livré' ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' : 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">{{ __('Packs Alimentaires Commandés') }}</h3>
                        @if($order->packAlimentaires->isNotEmpty())
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($order->packAlimentaires as $pack)
                                    <li>{{ $pack->nom }} - {{ number_format($pack->prix, 0, ',', ' ') }} FCFA</li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ __('Aucun pack alimentaire associé à cette commande.') }}</p>
                        @endif
                    </div>
                    
                    <div class="mt-6 flex justify-between items-center">
                        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Retour à la liste') }}
                        </a>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.orders.edit', $order) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:border-yellow-600 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Modifier') }}
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer cette commande ?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Supprimer') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</x-admin-layout>