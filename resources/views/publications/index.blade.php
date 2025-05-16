@extends('layouts.app')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">Публикации</li>
    </ol>
</nav>
@endsection

@section('page-header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">
        <i class="fas fa-file-alt me-2"></i> Научные публикации
    </h1>
    @can('admin')
    <a href="{{ route('publications.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Добавить публикацию
    </a>
    @endcan
</div>
@endsection

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="80">ID</th>
                        <th>Название</th>
                        <th>Журнал</th>
                        <th>Дата</th>
                        <th>Авторы</th>
                        <th width="150">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publications as $publication)
                    <tr>
                        <td>{{ $publication->id }}</td>
                        <td>{{ $publication->title }}</td>
                        <td>{{ $publication->journal->name ?? 'Не указан' }}</td>
                        <td>{{ $publication->publication_date->format('d.m.Y') }}</td>
                        <td>
                            @foreach($publication->authors as $author)
                            <span class="badge bg-secondary me-1">
                                {{ $author->person->full_name }}
                            </span>
                            @endforeach
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('publications.show', $publication->id) }}" class="btn btn-sm btn-outline-info" title="Просмотр">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('admin')
                                <a href="{{ route('publications.edit', $publication->id) }}" class="btn btn-sm btn-outline-warning" title="Редактировать">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('publications.destroy', $publication->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить публикацию?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($publications->hasPages())
        <div class="card-footer bg-transparent py-2">
            <nav aria-label="Page navigation">
                <ul class="pagination mb-0">
                    {{-- Previous Page Link --}}
                    <li class="page-item {{ $publications->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $publications->previousPageUrl() }}" aria-label="Previous">
                            <span class="d-none d-md-inline">Назад</span>
                            <span class="d-inline d-md-none">&laquo;</span>
                        </a>
                    </li>

                    {{-- Pagination Elements --}}
                    @foreach ($publications->getUrlRange(1, $publications->lastPage()) as $page => $url)
                        @if($page == $publications->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    <li class="page-item {{ !$publications->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $publications->nextPageUrl() }}" aria-label="Next">
                            <span class="d-none d-md-inline">Вперед</span>
                            <span class="d-inline d-md-none">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        @endif
    </div>
</div>
@endsection