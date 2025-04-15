@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $person->full_name }}</h1>
    <p>Дата рождения: {{ $person->birth_date?->format('d.m.Y') ?? 'Не указана' }}</p>
    
    <h2>Публикации автора:</h2>
    <ul class="list-group">
        @foreach($person->publications as $publication)
            <li class="list-group-item">
                <strong>{{ $publication->title }}</strong>
                <br>
                Журнал: {{ $publication->journal->name }}
                <br>
                <p>Дата публикации: {{ $publication->publication_date?->format('d.m.Y') ?? 'Не указана' }}</p>
                <br>
                Вклад автора: {{ $publication->pivot->contribution_share }}%
            </li>
        @endforeach
    </ul>
</div>
@endsection 