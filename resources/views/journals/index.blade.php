@extends('layouts.app')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">Журналы</li>
    </ol>
</nav>
@endsection

@section('page-header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">
        <i class="fas fa-book me-2"></i> Научные журналы
    </h1>
    @can('admin')
    <a href="{{ route('journals.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Добавить журнал
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
                        <th>Кол-во публикаций</th>
                        <th width="150">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($journals as $journal)
                    <tr>
                        <td>{{ $journal->id }}</td>
                        <td>
                            <a href="{{ route('journals.show', $journal->id) }}" class="text-decoration-none">
                                {{ $journal->name }}
                            </a>
                        </td>
                        <td>{{ $journal->publications_count ?? 0 }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('journals.show', $journal->id) }}" class="btn btn-sm btn-outline-info" title="Просмотр">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('admin')
                                <a href="{{ route('journals.edit', $journal->id) }}" class="btn btn-sm btn-outline-warning" title="Редактировать">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('journals.destroy', $journal->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить журнал?')">
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
        
        @if($journals->hasPages())
        <div class="card-footer bg-transparent">
            {{ $journals->links() }}
        </div>
        @endif
    </div>
</div>
@endsection