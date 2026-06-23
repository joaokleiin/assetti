<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center w-full rounded-full bg-sky-500 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-300 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
