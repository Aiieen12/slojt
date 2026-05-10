@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold leading-5 text-white shadow-sm transition duration-150 ease-in-out'
            : 'inline-flex items-center rounded-xl px-4 py-2 text-sm font-medium leading-5 text-slate-600 transition duration-150 ease-in-out hover:bg-slate-100 hover:text-slate-900 focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
