@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список публикаций</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Форма выбора количества элементов на странице -->
    <div class="row mb-4">
        <div class="col-md-3">
            <form method="GET" action="{{ route('publications.index') }}" class="form-inline">
                <div class="input-group">
                    <select name="per_page" class="form-select" onchange="this.form.submit()">
                        <option value="5" {{ $publications->perPage() == 5 ? 'selected' : '' }}>5 на странице</option>
                        <option value="10" {{ $publications->perPage() == 10 ? 'selected' : '' }}>10 на странице</option>
                        <option value="15" {{ $publications->perPage() == 15 ? 'selected' : '' }}>15 на странице</option>
                        <option value="20" {{ $publications->perPage() == 20 ? 'selected' : '' }}>20 на странице</option>
                    </select>
                    <span class="input-group-text">элементов</span>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-center">
            <!-- Информация о пагинации -->
            <div class="pagination-info">
                Показано с {{ $publications->firstItem() }} по {{ $publications->lastItem() }} из {{ $publications->total() }} записей
            </div>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('publications.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Добавить публикацию
            </a>
        </div>
    </div>

    <!-- Таблица с публикациями -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>@sortablelink('title', 'Название')</th>
                    <th>@sortablelink('journal.name', 'Журнал')</th>
                    <th>@sortablelink('publication_date', 'Дата публикации')</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($publications as $publication)
                    <tr>
                        <td>{{ $publication->title }}</td>
                        <td>{{ $publication->journal->name }}</td>
                        <td>{{ $publication->publication_date->format('d.m.Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('publications.edit', $publication->id) }}" 
                                   class="btn btn-sm btn-outline-warning" title="Редактировать">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('publications.destroy', $publication->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Вы уверены, что хотите удалить эту публикацию?')"
                                            title="Удалить">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Нет публикаций для отображения</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Пагинация -->
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-center">
            {{ $publications->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- Подключение иконок Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .pagination-info {
        padding: 8px;
        background-color: #f8f9fa;
        border-radius: 4px;
        display: inline-block;
    }
    .table th {
        white-space: nowrap;
    }
    .btn-group {
        white-space: nowrap;
    }
</style>
@endsection