<x-admin-layout>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Résultats de recherche pour : "{{ $query }}"</h2>
            </div>
            <div class="my-5">
                @if($packs->isEmpty() && $clients->isEmpty())
                    <p class="text-gray-700">Aucun résultat trouvé pour "{{ $query }}".</p>
                @else
                    @if($packs->isNotEmpty())
                        <h3 class="text-xl font-semibold leading-tight mt-6 mb-3">Packs Alimentaires</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($packs as $pack)
                                <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-all border border-gray-200">
                                    <h4 class="font-semibold text-lg">{{ $pack->nom }}</h4>
                                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($pack->description, 100) }}</p>
                                    <p class="text-indigo-600 font-bold text-lg">{{ $pack->prix }} FCFA</p>
                                    <a href="{{ route('admin.packs.show', $pack) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Voir détails</a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($clients->isNotEmpty())
                        <h3 class="text-xl font-semibold leading-tight mt-8 mb-3">Clients</h3>
                        <div class="overflow-x-auto bg-white rounded-lg shadow">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Nom Client
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Téléphone Client
                                        </th>
                                        {{-- La colonne Email n'est plus pertinente ici si on se base sur les commandes --}}
                                        {{-- <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Email
                                        </th> --}}
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $client->name }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $client->client_phone ?? 'N/A' }}</p>
                                        </td>
                                        {{-- La colonne Email n'est plus pertinente ici --}}
                                        {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $client->email }}</p>
                                        </td> --}}
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <a href="{{ route('admin.clients.showOrders', ['client_phone' => $client->client_phone, 'client_name' => urlencode($client->name)]) }}" class="text-indigo-600 hover:text-indigo-900">Voir Commandes</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>