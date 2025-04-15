<h1>Журналы</h1>
<ul>
    @foreach($journals as $journal)
        <li>
            <a href="{{ route('journals.show', $journal->id) }}">
                {{ $journal->name }}
            </a>
        </li>
    @endforeach
</ul>