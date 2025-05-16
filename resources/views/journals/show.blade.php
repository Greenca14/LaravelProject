@extends('layouts.app')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
        <li class="breadcrumb-item"><a href="{{ route('journals.index') }}">Журналы</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $journal->name }}</li>
    </ol>
</nav>
@endsection

@section('page-header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">
        <i class="fas fa-book me-2"></i> {{ $journal->name }}
    </h1>
    <div>
        @can('admin')
        <a href="{{ route('journals.edit', $journal->id) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-1"></i> Редактировать
        </a>
        @endcan
        <a href="{{ route('journals.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Назад
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Информация о журнале</h5>
                <dl class="row mb-0">
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">{{ $journal->id }}</dd>

                    <dt class="col-sm-3">Название:</dt>
                    <dd class="col-sm-9">{{ $journal->name }}</dd>

                    <dt class="col-sm-3">Публикаций:</dt>
                    <dd class="col-sm-9">{{ $journal->publications_count }}</dd>
                </dl>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Публикации в этом журнале</h5>
            </div>
            <div class="card-body">
                @if($journal->publications->count() > 0)
                <div class="list-group">
                    @foreach($journal->publications as $publication)
                    <a href="{{ route('publications.show', $publication->id) }}" 
                       class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1">{{ $publication->title }}</h6>
                            <small>{{ $publication->publication_date->format('d.m.Y') }}</small>
                        </div>
                        <div class="d-flex flex-wrap gap-1 mt-2">
                            @foreach($publication->authors as $author)
                            <span class="badge bg-secondary">
                                {{ $author->person->full_name }}
                            </span>
                            @endforeach
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="alert alert-info mb-0">
                    В этом журнале пока нет публикаций
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Статистика</h5>
                <canvas id="journalChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('journalChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Публикации', 'Авторы'],
                datasets: [{
                    data: [{{ $journal->publications_count }}, {{ $journal->publications->pluck('authors')->flatten()->unique('person_id')->count() }}],
                    backgroundColor: ['#3498db', '#2ecc71'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    });
</script>
@endsection