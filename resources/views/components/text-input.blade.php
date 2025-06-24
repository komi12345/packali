@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-transparent border-indigo-400 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm text-indigo-900 placeholder-indigo-400']) }}>
