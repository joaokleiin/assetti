@php
    $statusClasses = [
        'available' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
        'in_use' => 'bg-sky-50 text-sky-700 ring-sky-600/20',
        'maintenance' => 'bg-amber-50 text-amber-800 ring-amber-600/20',
        'reserved' => 'bg-violet-50 text-violet-700 ring-violet-600/20',
        'retired' => 'bg-gray-100 text-gray-700 ring-gray-600/20',
    ];

    $statusLabels = \App\Models\Equipment::statuses();
@endphp

<span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $statusClasses[$status] ?? 'bg-gray-100 text-gray-700 ring-gray-600/20' }}">
    {{ $statusLabels[$status] ?? $status }}
</span>
