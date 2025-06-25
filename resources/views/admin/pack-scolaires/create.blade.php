<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un Pack Scolaire') }}
        </h2>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Nouveau Pack Scolaire</h3>
                    <a href="{{ route('admin.pack-scolaires.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Retour à la liste
                    </a>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Erreur!</strong>
                        <ul class="mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.pack-scolaires.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom du Pack</label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>

                        <div>
                            <label for="prix" class="block text-sm font-medium text-gray-700">Prix (FCFA)</label>
                            <input type="number" name="prix" id="prix" value="{{ old('prix') }}" step="0.01" min="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>

                        <div>
                            <label for="niveau_scolaire" class="block text-sm font-medium text-gray-700">Niveau Scolaire</label>
                            <select name="niveau_scolaire" id="niveau_scolaire" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="">Sélectionner un niveau</option>
                                <option value="Maternelle" {{ old('niveau_scolaire') == 'Maternelle' ? 'selected' : '' }}>Maternelle</option>
                                <option value="CP" {{ old('niveau_scolaire') == 'CP' ? 'selected' : '' }}>CP</option>
                                <option value="CE1" {{ old('niveau_scolaire') == 'CE1' ? 'selected' : '' }}>CE1</option>
                                <option value="CE2" {{ old('niveau_scolaire') == 'CE2' ? 'selected' : '' }}>CE2</option>
                                <option value="CM1" {{ old('niveau_scolaire') == 'CM1' ? 'selected' : '' }}>CM1</option>
                                <option value="CM2" {{ old('niveau_scolaire') == 'CM2' ? 'selected' : '' }}>CM2</option>
                                <option value="6ème" {{ old('niveau_scolaire') == '6ème' ? 'selected' : '' }}>6ème</option>
                                <option value="5ème" {{ old('niveau_scolaire') == '5ème' ? 'selected' : '' }}>5ème</option>
                                <option value="4ème" {{ old('niveau_scolaire') == '4ème' ? 'selected' : '' }}>4ème</option>
                                <option value="3ème" {{ old('niveau_scolaire') == '3ème' ? 'selected' : '' }}>3ème</option>
                                <option value="Seconde" {{ old('niveau_scolaire') == 'Seconde' ? 'selected' : '' }}>Seconde</option>
                                <option value="Première" {{ old('niveau_scolaire') == 'Première' ? 'selected' : '' }}>Première</option>
                                <option value="Terminale" {{ old('niveau_scolaire') == 'Terminale' ? 'selected' : '' }}>Terminale</option>
                                <option value="Universitaire" {{ old('niveau_scolaire') == 'Universitaire' ? 'selected' : '' }}>Universitaire</option>
                            </select>
                        </div>

                        <div>
                            <label for="tag" class="block text-sm font-medium text-gray-700">Tag</label>
                            <select name="tag" id="tag" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="">Sélectionner un tag</option>
                                <option value="Populaire" {{ old('tag') == 'Populaire' ? 'selected' : '' }}>Populaire</option>
                                <option value="Économique" {{ old('tag') == 'Économique' ? 'selected' : '' }}>Économique</option>
                                <option value="Premium" {{ old('tag') == 'Premium' ? 'selected' : '' }}>Premium</option>
                                <option value="Complet" {{ old('tag') == 'Complet' ? 'selected' : '' }}>Complet</option>
                                <option value="Essentiel" {{ old('tag') == 'Essentiel' ? 'selected' : '' }}>Essentiel</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mt-6">
                        <label for="contenu" class="block text-sm font-medium text-gray-700">Contenu du Pack (Liste des fournitures)</label>
                        <textarea name="contenu" id="contenu" rows="6" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Ex: - 10 cahiers 96 pages&#10;- 5 stylos bleus&#10;- 2 crayons à papier&#10;- 1 règle 30cm&#10;- 1 gomme..." required>{{ old('contenu') }}</textarea>
                    </div>

                    <div class="mt-6">
                        <label for="image" class="block text-sm font-medium text-gray-700">Image du Pack</label>
                        <input type="file" name="image" id="image" accept="image/*" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <p class="mt-2 text-sm text-gray-500">Formats acceptés: JPG, PNG, GIF, SVG. Taille max: 2MB</p>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Créer le Pack
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
