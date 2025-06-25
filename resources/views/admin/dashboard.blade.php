<x-admin-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Tableau de bord</h1>
    </div>
    
    <!-- Statistiques générales -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-600 text-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-3xl font-bold">{{ $totalOrders }}</h4>
                    <p class="text-blue-100 mt-1">Commandes totales</p>
                </div>
                <div class="bg-blue-500 rounded-full p-3">
                    <span class="material-symbols-outlined text-2xl">receipt_long</span>
                </div>
            </div>
        </div>
        
        <div class="bg-green-600 text-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-3xl font-bold">{{ number_format($totalRevenue, 0, ',', ' ') }} FCFA</h4>
                    <p class="text-green-100 mt-1">Chiffre d'affaires</p>
                </div>
                <div class="bg-green-500 rounded-full p-3">
                    <span class="material-symbols-outlined text-2xl">payments</span>
                </div>
            </div>
        </div>
        
        <div class="bg-yellow-600 text-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-3xl font-bold">{{ $totalClients }}</h4>
                    <p class="text-yellow-100 mt-1">Clients</p>
                </div>
                <div class="bg-yellow-500 rounded-full p-3">
                    <span class="material-symbols-outlined text-2xl">people</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques des packs -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-gray-600 mr-2">restaurant_menu</span>
                    <h3 class="text-lg font-semibold text-gray-900">Packs Alimentaires</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="text-center">
                        <div class="text-sm text-gray-500 mb-1">Total des packs</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalFoodPacks }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-sm text-gray-500 mb-1">Packs vendus</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $foodPacksSold }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-sm text-gray-500 mb-1">Revenus</div>
                        <div class="text-2xl font-bold text-gray-900">{{ number_format($foodPacksRevenue, 0, ',', ' ') }} FCFA</div>
                    </div>
                </div>
                <div class="border-t border-gray-200 pt-4">
                    <h6 class="text-sm font-semibold text-gray-700 mb-3">Top 5 des packs les plus vendus</h6>
                    <ul class="space-y-2">
                        @foreach($topFoodPacks as $pack)
                        <li class="flex justify-between items-center py-2 px-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-700">{{ $pack->nom }}</span>
                            <span class="text-sm font-medium text-gray-900">{{ $pack->orders_count }} ventes</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-gray-600 mr-2">school</span>
                    <h3 class="text-lg font-semibold text-gray-900">Packs Scolaires</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="text-center">
                        <div class="text-sm text-gray-500 mb-1">Total des packs</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalSchoolPacks }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-sm text-gray-500 mb-1">Packs vendus</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $schoolPacksSold }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-sm text-gray-500 mb-1">Revenus</div>
                        <div class="text-2xl font-bold text-gray-900">{{ number_format($schoolPacksRevenue, 0, ',', ' ') }} FCFA</div>
                    </div>
                </div>
                <div class="border-t border-gray-200 pt-4">
                    <h6 class="text-sm font-semibold text-gray-700 mb-3">Top 5 des packs les plus vendus</h6>
                    <ul class="space-y-2">
                        @foreach($topSchoolPacks as $pack)
                        <li class="flex justify-between items-center py-2 px-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-700">{{ $pack->nom }}</span>
                            <span class="text-sm font-medium text-gray-900">{{ $pack->orders_count }} ventes</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-gray-600 mr-2">bar_chart</span>
                    <h3 class="text-lg font-semibold text-gray-900">Ventes mensuelles</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="relative h-80">
                    <canvas id="monthlySalesChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-gray-600 mr-2">pie_chart</span>
                    <h3 class="text-lg font-semibold text-gray-900">Répartition des ventes</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="relative h-80">
                    <canvas id="salesDistributionChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique des ventes mensuelles
    const monthlySalesCtx = document.getElementById('monthlySalesChart');
    new Chart(monthlySalesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($lastSixMonths->pluck('month')) !!},
            datasets: [
                {
                    label: 'Packs Alimentaires',
                    data: {!! json_encode($lastSixMonths->pluck('food_packs')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                },
                {
                    label: 'Packs Scolaires',
                    data: {!! json_encode($lastSixMonths->pluck('school_packs')) !!},
                    backgroundColor: 'rgba(255, 159, 64, 0.5)',
                    borderColor: 'rgb(255, 159, 64)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Graphique de répartition des ventes
    const salesDistributionCtx = document.getElementById('salesDistributionChart');
    new Chart(salesDistributionCtx, {
        type: 'pie',
        data: {
            labels: ['Packs Alimentaires', 'Packs Scolaires'],
            datasets: [{
                data: [{{ $packDistribution['food'] }}, {{ $packDistribution['school'] }}],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgb(75, 192, 192)',
                    'rgb(255, 159, 64)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endpush
</x-admin-layout>
