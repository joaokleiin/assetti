@php
    $statusClasses = [
        'open' => 'bg-rose-50 text-rose-700 ring-rose-600/20',
        'in_progress' => 'bg-amber-50 text-amber-800 ring-amber-600/20',
        'completed' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
        'canceled' => 'bg-gray-100 text-gray-700 ring-gray-600/20',
    ];

    $statusLabels = \App\Models\Maintenance::statuses();
@endphp

<span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $statusClasses[$status] ?? 'bg-gray-100 text-gray-700 ring-gray-600/20' }}">
    {{ $statusLabels[$status] ?? $status }}
</span>
