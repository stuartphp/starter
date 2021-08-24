@props([
    'icon' => null,
    'label' => null,
    'items' => null,
    'color' => 'white',
    'size' => 'sm',
])

@php
    $attributes = $attributes->class([
        'btn btn-' . $color,
        'btn-' . $size => $size,
    ])->merge([
        'type' => 'button',
        'data-bs-toggle' => 'dropdown',
    ]);
@endphp

<div class="btn-group dropstart">
    <x-bs::button {{ $attributes }}>
        <x-bs::icon :name="$icon"/>

        {{ $label }}
    </x-bs::button>

    <div class="dropdown-menu">
        {{ $items ?? $slot }}
    </div>
</div>
