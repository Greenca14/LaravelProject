@extends('layouts.app')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
        <li class="breadcrumb-item"><a href="{{ route('publications.index') }}">Публикации</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($publication->title, 30) }}</li>
    </ol>
</nav>
@endsection

@section('page-header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">
        <i class="fas fa-file-alt me-2"></i> {{ $publication->title }}
    </h1>
    <div>
        @can('admin')
        <a href="{{ route('publications.edit', $publication->id) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-1"></i> Редактировать
        </a>
        @endcan
        <a href="{{ route('publications.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Назад
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        @if($publication->journal)
                        <span class="badge bg-primary mb-2">
                            {{ $publication->journal->name }}
                        </span>
                        @endif
                        <p class="text-muted mb-0">
                            <i class="far fa-calendar-alt me-1"></i> 
                            Опубликовано: {{ $publication->publication_date->format('d.m.Y') }}
                        </p>
                    </div>
                    <div class="text-end">
                        <p class="text-muted mb-0">
                            ID: {{ $publication->id }}
                        </p>
                    </div>
                </div>

                @if($publication->abstract)
                <div class="mb-4">
                    <h5 class="mb-3">Аннотация</h5>
                    <div class="bg-light p-3 rounded">
                        {{ $publication->abstract }}
                    </div>
                </div>
                @endif

                @if($publication->keywords)
                <div class="mb-4">
                    <h5 class="mb-3">Ключевые слова</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach(explode(',', $publication->keywords) as $keyword)
                        <span class="badge bg-secondary">{{ trim($keyword) }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if($publication->full_text)
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Полный текст</h5>
            </div>
            <div class="card-body">
                <div class="publication-content">
                    {!! nl2br(e($publication->full_text)) !!}
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Авторы</h5>
            </div>
            <div class="card-body">
                @if($publication->authors->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($publication->authors as $author)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">{{ $author->person->full_name }}</h6>
                            <small class="text-muted">
                                {{ $author->person->birth_date->format('d.m.Y') }}
                            </small>
                        </div>
                        <span class="badge bg-primary rounded-pill">
                            {{ $author->contribution_share }}%
                        </span>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="alert alert-info mb-0">
                    Авторы не указаны
                </div>
                @endif
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Дополнительная информация</h5>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-5">Дата создания:</dt>
                    <dd class="col-sm-7">{{ $publication->created_at->format('d.m.Y H:i') }}</dd>

                    <dt class="col-sm-5">Последнее обновление:</dt>
                    <dd class="col-sm-7">{{ $publication->updated_at->format('d.m.Y H:i') }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .publication-content {
        line-height: 1.6;
    }
    
    .publication-content p {
        margin-bottom: 1rem;
    }
    
    .list-group-item {
        border-left: 0;
        border-right: 0;
        padding: 1rem 0;
    }
    
    .list-group-item:first-child {
        border-top: 0;
        padding-top: 0;
    }
    
    .list-group-item:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }
</style>
@endsection