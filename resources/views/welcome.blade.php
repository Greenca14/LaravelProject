@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <div class="mb-5">
                <h1 class="display-4 fw-bold mb-3">Система учета научных публикаций</h1>
                <p class="lead text-muted">Управление научными публикациями, авторами и журналами</p>
                
                @auth
                <div class="d-inline-block bg-light p-4 rounded-3 mb-4">
                    <h4 class="mb-3">Добро пожаловать, {{ Auth::user()->name }}!</h4>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('publications.index') }}" class="btn btn-primary px-4">
                            <i class="fas fa-file-alt me-2"></i> Публикации
                        </a>
                        <a href="{{ route('journals.index') }}" class="btn btn-success px-4">
                            <i class="fas fa-book me-2"></i> Журналы
                        </a>
                        <a href="{{ route('persons.index') }}" class="btn btn-info px-4">
                            <i class="fas fa-users me-2"></i> Персоны
                        </a>
                    </div>
                </div>
                @else
                <div class="d-inline-block bg-light p-4 rounded-3 mb-4">
                    <h4 class="mb-3">Для работы с системой требуется авторизация</h4>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('login') }}" class="btn btn-primary px-4">
                            <i class="fas fa-sign-in-alt me-2"></i> Войти
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-user-plus me-2"></i> Регистрация
                        </a>
                    </div>
                </div>
                @endauth
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center py-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-file-alt fa-2x"></i>
                            </div>
                            <h3 class="h4">Публикации</h3>
                            <p class="text-muted mb-3">Научные работы и исследования</p>
                            @auth
                                <a href="{{ route('publications.index') }}" class="btn btn-outline-primary">Перейти</a>
                            @else
                                <button class="btn btn-outline-primary" disabled>Требуется вход</button>
                            @endauth
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center py-4">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-book fa-2x"></i>
                            </div>
                            <h3 class="h4">Журналы</h3>
                            <p class="text-muted mb-3">Научные издания и сборники</p>
                            @auth
                                <a href="{{ route('journals.index') }}" class="btn btn-outline-success">Перейти</a>
                            @else
                                <button class="btn btn-outline-success" disabled>Требуется вход</button>
                            @endauth
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center py-4">
                            <div class="bg-info bg-opacity-10 text-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                            <h3 class="h4">Персоны</h3>
                            <p class="text-muted mb-3">Авторы и исследователи</p>
                            @auth
                                <a href="{{ route('persons.index') }}" class="btn btn-outline-info">Перейти</a>
                            @else
                                <button class="btn btn-outline-info" disabled>Требуется вход</button>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection