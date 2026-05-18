@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'view',
    'title' => '',
])

@php
    $classes = [
        'view' => 'bg-sky-50 text-sky-600 hover:bg-sky-100',
        'edit' => 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100',
        'report' => 'bg-indigo-50 text-indigo-600 hover:bg-indigo-100',
        'delete' => 'bg-red-50 text-red-600 hover:bg-red-100',
        'restore' => 'bg-amber-50 text-amber-600 hover:bg-amber-100',
    ][$variant] ?? 'bg-slate-50 text-slate-600 hover:bg-slate-100';

    $baseClass = 'inline-flex items-center justify-center px-3 py-2 rounded-lg transition-all duration-200 hover:scale-110 ' . $classes;
@endphp

@if ($href)
    <a href="{{ $href }}" title="{{ $title }}" {{ $attributes->merge(['class' => $baseClass]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" title="{{ $title }}" {{ $attributes->merge(['class' => $baseClass]) }}>
        {{ $slot }}
    </button>
@endif
