<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Clients') }}
        </h2>
    </div>

    <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h3 class="text-lg font-medium text-gray-900 mb-4">Clients avec Commandes Livrées</h3>
                    @if($deliveredOrdersClients->count() > 0)
                        <div class="overflow-x-auto mb-8">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom du Client</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléphone</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adresse de Livraison</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de Commande</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Packs Commandés</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($deliveredOrdersClients as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->client_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->client_phone }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->delivery_address }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->order_date->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @foreach($order->packAlimentaires as $pack)
                                                    {{ $pack->nom }}@if(!$loop->last), @endif
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="tel:{{ $order->client_phone }}" class="text-indigo-600 hover:text-indigo-900 mr-2" title="Appeler">
                                                    <span class="material-symbols-outlined">call</span>
                                                </a>
                                                <a href="https://wa.me/{{ $order->client_phone }}?text=Bonjour%20{{ urlencode($order->client_name) }}%2C%20concernant%20votre%20commande..." target="_blank" class="text-green-600 hover:text-green-900" title="Contacter sur WhatsApp">
                                                    <span class="material-symbols-outlined">sms</span> <!-- Utiliser une icône appropriée pour WhatsApp -->
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">Aucun client avec des commandes livrées pour le moment.</p>
                    @endif

                    <h3 class="text-lg font-medium text-gray-900 mb-4 mt-8">Clients avec Commandes en Cours / Non Livrées</h3>
                     @if($pendingOrdersClients->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom du Client</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléphone</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adresse de Livraison</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de Commande</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Packs Commandés</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($pendingOrdersClients as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->client_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->client_phone }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->delivery_address }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->order_date->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @foreach($order->packAlimentaires as $pack)
                                                    {{ $pack->nom }}@if(!$loop->last), @endif
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="tel:{{ $order->client_phone }}" class="text-indigo-600 hover:text-indigo-900 mr-2" title="Appeler">
                                                    <span class="material-symbols-outlined">call</span>
                                                </a>
                                                <a href="https://wa.me/{{ $order->client_phone }}?text=Bonjour%20{{ urlencode($order->client_name) }}%2C%20concernant%20votre%20commande..." target="_blank" class="text-green-600 hover:text-green-900" title="Contacter sur WhatsApp">
                                                    <span class="material-symbols-outlined">sms</span> <!-- Utiliser une icône appropriée pour WhatsApp -->
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">Aucun client avec des commandes en cours ou non livrées pour le moment.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @push('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @endpush
</x-admin-layout>