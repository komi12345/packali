<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistiques des Ventes') }}
        </h2>
    </div>

    <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Filtres de Période -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('admin.analytics.index') }}" class="flex items-center space-x-4">
                            <div>
                                <label for="period" class="block text-sm font-medium text-gray-700">Filtrer par période :</label>
                                <select id="period" name="period" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="today" {{ request('period', 'today') == 'today' ? 'selected' : '' }}>Aujourd'hui</option>
                                    <option value="this_week" {{ request('period') == 'this_week' ? 'selected' : '' }}>Cette Semaine</option>
                                    <option value="this_month" {{ request('period') == 'this_month' ? 'selected' : '' }}>Ce Mois</option>
                                    <option value="this_year" {{ request('period') == 'this_year' ? 'selected' : '' }}>Cette Année</option>
                                    <option value="all_time" {{ request('period') == 'all_time' ? 'selected' : '' }}>Tout l'historique</option>
                                </select>
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Filtrer
                            </button>
                        </form>
                    </div>

                    <!-- Statistiques des Commandes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <div class="bg-green-100 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-medium text-green-800">Commandes Livrées</h3>
                            <p class="text-3xl font-bold text-green-700">{{ $stats['delivered_orders_count'] }}</p>
                            <p class="text-sm text-green-600">Valeur : {{ number_format($stats['delivered_orders_value'], 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div class="bg-yellow-100 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-medium text-yellow-800">Commandes en Attente/Non Livrées</h3>
                            <p class="text-3xl font-bold text-yellow-700">{{ $stats['pending_orders_count'] }}</p>
                            <p class="text-sm text-yellow-600">Valeur : {{ number_format($stats['pending_orders_value'], 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div class="bg-blue-100 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-medium text-blue-800">Total des Ventes (Période Sélectionnée)</h3>
                            <p class="text-3xl font-bold text-blue-700">{{ number_format($stats['total_sales_period'], 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>

                    <!-- Historique des Ventes (Graphique) -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Historique des Ventes</h3>
                        {{-- Ici, vous pourriez intégrer une librairie de graphiques comme Chart.js --}}
                        {{-- Pour l'instant, affichons des données brutes si disponibles --}}
                        @if(isset($stats['sales_history']) && count($stats['sales_history']) > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Ventes</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($stats['sales_history'] as $entry)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry['date'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($entry['total'], 0, ',', ' ') }} FCFA</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">Aucun historique de ventes disponible pour la période sélectionnée.</p>
                        @endif
                    </div>

                    {{-- Potentiellement d'autres sections d'analyse ici --}}

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    {{-- Si vous utilisez Chart.js ou une autre librairie, incluez les scripts ici --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    {{-- <script>
        // Logique pour initialiser les graphiques
    </script> --}}
    @endpush
</x-admin-layout>