@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список публикаций</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Название</th>
                <th>Журнал</th>
                <th>Дата</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($publications as $publication)
                <tr>
                    <td>{{ $publication->title }}</td>
                    <td>{{ $publication->journal->name }}</td>
                    <td>{{ $publication->publication_date->format('d.m.Y') }}</td>
                    <td>
                        <a href="{{ route('publications.edit', $publication->id) }}" class="btn btn-sm btn-warning">✏️</a>
                        <form action="{{ route('publications.destroy', $publication->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <a href="{{ route('publications.create') }}" class="btn btn-primary">Добавить публикацию</a>
</div>
@endsection