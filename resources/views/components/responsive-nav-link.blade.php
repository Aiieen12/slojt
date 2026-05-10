@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-xl bg-slate-900 px-4 py-3 text-start text-base font-semibold text-white transition duration-150 ease-in-out'
            : 'block w-full rounded-xl px-4 py-3 text-start text-base font-medium text-slate-600 transition duration-150 ease-in-out hover:bg-slate-100 hover:text-slate-900 focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
