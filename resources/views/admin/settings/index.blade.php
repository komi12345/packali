<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </div>

    <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Theme Settings -->
                    <section class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('Theme Settings') }}</h3>
                        <form method="POST" action="{{ route('admin.settings.theme.update') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="theme" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Select Theme') }}</label>
                                <select id="theme" name="theme" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="light" {{ session('theme', 'light') == 'light' ? 'selected' : '' }}>{{ __('Light Mode') }}</option>
                                    <option value="dark" {{ session('theme', 'light') == 'dark' ? 'selected' : '' }}>{{ __('Dark Mode') }}</option>
                                </select>
                            </div>
                            <div>
                                <x-primary-button>
                                    {{ __('Update Theme') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </section>

                    <!-- Admin User Management -->
                    <section>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('Admin User Management') }}</h3>
                        
                        <!-- Add New Admin User Form -->
                        <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h4 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-3">{{ __('Add New Admin User') }}</h4>
                            <form method="POST" action="{{ route('admin.settings.users.store') }}">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="password" :value="__('Password')" />
                                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                                    </div>
                                    <div class="mt-4">
                                        <label for="is_admin" class="inline-flex items-center">
                                            <input id="is_admin" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="is_admin" value="1" checked>
                                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Is Admin?') }}</span>
                                        </label>
                                    </div>
                                    <div class="mt-4">
                                        <label for="is_super_admin" class="inline-flex items-center">
                                            <input id="is_super_admin" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="is_super_admin" value="1">
                                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Is Super Admin?') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <x-primary-button>
                                        {{ __('Add Admin User') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>

                        <!-- List of Admin Users -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Name') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Email') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Role') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $user->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                @if ($user->is_super_admin)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">{{ __('Super Admin') }}</span>
                                                @elseif ($user->is_admin)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">{{ __('Admin') }}</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('admin.settings.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 mr-3">{{ __('Edit') }}</a>
                                                <form method="POST" action="{{ route('admin.settings.users.destroy', $user) }}" class="inline-block" onsubmit="return confirm('{{ __('Are you sure you want to delete this user?') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">{{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
    </div>
</x-admin-layout>