<h1>{{ $journal->name }}</h1>
<h2>Публикации в этом журнале:</h2>
<ul>
    @foreach($journal->publications as $publication)
        <li>{{ $publication->title }}</li>
    @endforeach
</ul> 