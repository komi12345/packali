<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Pack Alimentaire') }}: {{ $packAlimentaire->nom }}
        </h2>
    </div>

    <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-1">
                            @if($packAlimentaire->image)
                                <img src="{{ asset('site_assets/images/' . $packAlimentaire->image) }}" alt="{{ $packAlimentaire->nom }}" class="w-full h-auto object-cover rounded-lg shadow-md">
                            @else
                                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 shadow-md">
                                    Aucune image disponible
                                </div>
                            @endif
                        </div>
                        <div class="md:col-span-2">
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $packAlimentaire->nom }}</h3>
                            
                            @if($packAlimentaire->tag)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full mb-3">
                                    {{ $packAlimentaire->tag }}
                                </span>
                            @endif

                            <p class="text-3xl font-bold text-green-600 mb-4">{{ number_format($packAlimentaire->prix, 0, ',', ' ') }} FCFA</p>
                            
                            <div class="mb-4">
                                <h4 class="font-semibold text-gray-700 mb-1">Description:</h4>
                                <p class="text-gray-600 leading-relaxed">{{ $packAlimentaire->description }}</p>
                            </div>

                            <div>
                                <h4 class="font-semibold text-gray-700 mb-1">Contenu du Pack:</h4>
                                <ul class="list-disc list-inside text-gray-600 space-y-1">
                                    @foreach(explode("\n", $packAlimentaire->contenu) as $item)
                                        @if(trim($item) !== '')
                                            <li>{{ trim($item) }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 border-t pt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.packs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Retour à la liste
                        </a>
                        <a href="{{ route('admin.packs.edit', $packAlimentaire->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:border-yellow-600 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Modifier
                        </a>
                        <form action="{{ route('admin.packs.destroy', $packAlimentaire->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce pack ?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</x-admin-layout>