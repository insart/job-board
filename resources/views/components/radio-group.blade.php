<div>
    <label for="{{ $name }}" class="flex mb-1 items-center gap-2">
        <input type="radio" name="{{ $name }}" value="" @checked(!request($name))/>
        <span class="text-sm ml-s">All</span>
    </label>

    @foreach($options as $key => $option)
        <label for="{{ $name }}" class="flex mb-1 items-center gap-2">
            <input type="radio" name="{{ $name }}" value="{{ $option }}"
                    @checked(request($name) === $option)/>
            <span class="text-sm ml-s">{{ $key }}</span>
        </label>
    @endforeach
</div>