@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать публикацию</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('publications.update', $publication->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="journal_id" class="form-label">Журнал</label>
            <select name="journal_id" id="journal_id" class="form-select">
                @foreach($journals as $journal)
                    <option value="{{ $journal->id }}" {{ $publication->journal_id == $journal->id ? 'selected' : '' }}>
                        {{ $journal->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="title" class="form-label">Название</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $publication->title) }}">
        </div>
        
        <div class="mb-3">
            <label for="publication_date" class="form-label">Дата публикации</label>
            <input type="date" class="form-control" id="publication_date" name="publication_date" value="{{ old('publication_date', $publication->publication_date) }}">
        </div>
        
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
</div>
@endsection