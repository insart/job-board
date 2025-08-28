<button {{ $attributes->class([
    'rounded-md border border-gray-300 bg-white px-2 py-1.5 text-center text-sm font-semibold text-blue-700
    shadow-sm hover:bg-gray-100'
    ]) }}>
    {{ $slot }}
</button>