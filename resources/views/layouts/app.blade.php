<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Научные публикации | @yield('title')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .pagination {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 4px;
            margin: 0;
            padding: 0;
        }

        .pagination-sm {
            padding-left: calc(1.5rem - 0.375rem);
        }

        .pagination-sm a {
            padding: 0.25rem 0.25rem;
        }
        
        .page-item {
            list-style: none;
            margin: 0;
        }

        .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 8px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }

        .page-item:first-child .page-link,
        .page-item:last-child .page-link {
            padding: 0 12px;
        }

        .page-link i {
            vertical-align: middle;
            font-size: 1rem;
        }

        .page-item.active .page-link {
            background-color: #3498db;
            border-color: #3498db;
            color: white;
        }

        .page-item.disabled .page-link {
            color: #adb5bd;
            pointer-events: none;
        }


        .page-link:hover {
            background-color: #f8f9fa;
            color: #2c7be5;
        }

        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            padding-top: 60px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .navbar-brand {
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            margin-right: 10px;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            border: none;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .action-buttons .btn {
            margin-right: 5px;
        }
        
        html, body {
            height: 100%;
        }

        footer {
            flex-shrink: 0; /* Не сжимается */
            background-color: #343a40;
            color: white;
            padding: 2rem 0;
            margin-top: auto; /* Прижимает футер вниз */
        }
        
        .breadcrumb {
        background-color: transparent;
        padding: 0.5rem 0;
        }

        .breadcrumb a {
        padding: 0.375rem 1rem;
        border-radius: 4px;
        color: var(--primary-color);
        font-size: 0.8em;
        text-decoration: none;
        }
        
        @media print {
            .breadcrumb a {
                display: inline-block;
            }
        }

        .breadcrumb a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--primary-color);
        }

    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Навбар -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-book-open"></i>
                <span>Научные публикации</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('publications.*')) active @endif" 
                           href="{{ route('publications.index') }}">
                            <i class="fas fa-file-alt me-1"></i> Публикации
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('journals.*')) active @endif" 
                           href="{{ route('journals.index') }}">
                            <i class="fas fa-book me-1"></i> Журналы
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('persons.*')) active @endif" 
                           href="{{ route('persons.index') }}">
                            <i class="fas fa-users me-1"></i> Персоны
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user me-1"></i> Профиль
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog me-1"></i> Настройки
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-1"></i> Выйти
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Вход
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-1"></i> Регистрация
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Основной контент -->
    <main class="container py-4">
        @yield('breadcrumbs')
        @yield('page-header')
        
        <!-- Флэш-сообщения -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- Футер -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5><i class="fas fa-book-open me-2"></i> Научные публикации</h5>
                    <p>Система учета научных публикаций и их авторов</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Разделы</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('publications.index') }}" class="text-decoration-none text-white">Публикации</a></li>
                        <li><a href="{{ route('journals.index') }}" class="text-decoration-none text-white">Журналы</a></li>
                        <li><a href="{{ route('persons.index') }}" class="text-decoration-none text-white">Персоны</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Контакты</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2 text-muted"></i> info@sciencepub.ru</li>
                        <li><i class="fas fa-phone me-2 text-muted"></i> +7 (123) 456-78-90</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="text-center text-muted">
                <small>© {{ date('Y') }} Научные публикации. Все права защищены.</small>
            </div>
        </div>
    </footer>

    <!-- Скрипты -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>