<nav {{ $attributes }}>
    <ul class="flex items-center">
        <li>
            <a href="/">
                🏠
            </a>
        </li>

        @foreach($breadcrumbs as $label => $link)
            <li><p class="px-2">-></p></li>
            <li>
                <a href="{{ $link }}">
                    {{ $label }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>