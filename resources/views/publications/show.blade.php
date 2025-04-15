<h1>{{ $publication->title }}</h1>
<h2>Авторы:</h2>
<ul>
    @foreach($publication->authors as $author)
        <li>{{ $author->person->full_name }}</li>
    @endforeach
</ul>