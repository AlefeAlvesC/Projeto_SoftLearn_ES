@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full bg-transparent border-t-0 border-x-0 border-b-2 border-gray-300 focus:border-indigo-500 focus:ring-0 transition-colors']) }}>
