@extends('layouts.app')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light p-2 rounded-2">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Персоны</li>
    </ol>
</nav>
@endsection

@section('page-header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">
        <i class="fas fa-users me-2"></i> Персоны
    </h1>
    <div>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-home"></i>
        </a>
        @can('admin')
        <a href="{{ route('persons.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Добавить
        </a>
        @endcan
    </div>
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
                        <th>ФИО</th>
                        <th>Дата рождения</th>
                        <th width="150">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($persons as $person)
                    <tr>
                        <td>{{ $person->id }}</td>
                        <td>{{ $person->full_name }}</td>
                        <td>{{ $person->birth_date->format('d.m.Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('persons.show', $person->id) }}" class="btn btn-sm btn-outline-info" title="Просмотр">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('admin')
                                <a href="{{ route('persons.edit', $person->id) }}" class="btn btn-sm btn-outline-warning" title="Редактировать">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('persons.destroy', $person->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить персону?')">
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
        
        @if($persons->hasPages())
        <div class="card-footer bg-transparent">
            {{ $persons->links() }}
        </div>
        @endif
    </div>
</div>
@endsection