<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Pack Scolaire') }}
        </h2>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">{{ $packScolaire->nom }}</h3>
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.pack-scolaires.edit', $packScolaire->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-700 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Modifier
                        </a>
                        <a href="{{ route('admin.pack-scolaires.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Retour à la liste
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        @if($packScolaire->image)
                            <div class="mb-6">
                                <img src="{{ asset('site_assets/images/' . $packScolaire->image) }}" alt="{{ $packScolaire->nom }}" class="w-full h-64 object-cover rounded-lg shadow-md">
                            </div>
                        @endif

                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h4 class="font-medium text-gray-900 mb-2">Informations Générales</h4>
                            <dl class="grid grid-cols-2 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Prix</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ number_format($packScolaire->prix, 0, ',', ' ') }} FCFA</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Niveau Scolaire</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $packScolaire->niveau_scolaire ?? 'Non spécifié' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tag</dt>
                                    <dd class="mt-1">
                                        @if($packScolaire->tag)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $packScolaire->tag }}
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-500">Non spécifié</span>
                                        @endif
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Date de création</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $packScolaire->created_at->format('d/m/Y') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div>
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-900 mb-2">Description</h4>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-sm text-gray-700 whitespace-pre-line">{{ $packScolaire->description }}</p>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Contenu du Pack</h4>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="text-sm text-gray-700 whitespace-pre-line">{{ $packScolaire->contenu }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($packScolaire->promotions->count() > 0)
                    <div class="mt-8">
                        <h4 class="font-medium text-gray-900 mb-4">Promotions Actives</h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <ul class="divide-y divide-gray-200">
                                @foreach($packScolaire->promotions as $promotion)
                                    <li class="py-3">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $promotion->titre }}</p>
                                                <p class="text-sm text-gray-500">{{ $promotion->description }}</p>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $promotion->reduction }}% de réduction
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
