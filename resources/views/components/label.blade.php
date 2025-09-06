<label for="{{ $for }}" class="mb-1 block text-sm font-medium text-gray-700">
    {{ $label }} @if($required)  <span class="text-red-500">*</span>

    @endif
    {{ $slot }}
</label>