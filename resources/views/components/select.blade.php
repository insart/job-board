<div>
    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->class([
                    'w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-gray-400 focus:ring-2
                    file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold
                    file:bg-gray-200 file:text-gray-700 hover:file:bg-blue-100',
                    'ring-slate-300' => !$errors->has($name),
                    'ring-red-300' => $errors->has($name),
                ]) }}>
        <option value="" class="text-gray-500">{{ $placeholder }}</option>
        @foreach($options as $option)
            <option value="{{ $option }}" @selected(old($name, $selected) == $option)>
                {{ Str::ucfirst($option) }}
            </option>
        @endforeach
    </select>
    @error($name)
    <div class="mt-1 text-xs text-red-500">
        {{ $message }}
    </div>
    @enderror
</div>