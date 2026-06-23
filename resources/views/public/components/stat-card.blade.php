{{-- Statistics Card Component
    Displays a single statistic with icon, title and numeric value.
    
    Props:
    - $title (string): Label for the statistic
    - $value (int): Numeric value to display
    - $bgClass (string): Tailwind background color class
    - $textClass (string): Tailwind text color class
    - $icon (string): SVG icon HTML
--}}
<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between gap-4">
        <div>
            <p class="text-sm font-medium text-slate-500">{{ $title }}</p>
            <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $value }}</p>
        </div>
        <div class="flex h-12 w-12 items-center justify-center rounded-2xl {{ $bgClass }} {{ $textClass }}">
            {!! $icon !!}
        </div>
    </div>
</div>
