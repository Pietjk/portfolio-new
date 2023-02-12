@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#09aac0] focus:ring-[#09aac0] rounded-md shadow-sm text-black']) !!}>
