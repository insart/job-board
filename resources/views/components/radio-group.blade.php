<div>
    @if($all)
    <label for="{{ $name }}" class="flex mb-1 items-center gap-2">
        <input type="radio" name="{{ $name }}" value="" @checked(!request($name))/>
        <span class="text-sm ml-s">All</span>
    </label>
    @endif

    @foreach($options as $key => $option)
        <label for="{{ $name }}" class="flex mb-1 items-center gap-2">
            <input type="radio" name="{{ $name }}" value="{{ $option }}"
                    @checked(old($name, $selected) === $option)/>
            <span class="text-sm ml-s">{{ $key }}</span>
        </label>
    @endforeach
</div>