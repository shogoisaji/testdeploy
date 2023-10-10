@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-mg text-gray-700 dark:text-gray-100']) }}>
    {{ $value ?? $slot }}
</label>
