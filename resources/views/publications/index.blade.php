<h1>Публикации</h1>
<ul>
    @foreach($publications as $publication)
        <li>
            <a href="{{ route('publications.show', $publication->id) }}">
                {{ $publication->title }}
            </a>
        </li>
    @endforeach
</ul> 