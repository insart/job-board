<div class="relative">
    @if($formRef)
        <button type="button"
                class="absolute top-0 right-0 flex items-center justify-center h-full px-2 text-gray-400"
                @click="$refs['{{ $name }}'].value = ''; $refs['{{ $formRef }}'].submit();"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor"
                 class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z"/>
            </svg>
        </button>
    @endif
    <input x-ref="{{ $name }}" type="text" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" id="{{ $name }}"
           class="w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50
rounded-md shadow-sm placeholder:text-gray-400 focus:ring-2 px-3 py-2 pr-9" />
</div>