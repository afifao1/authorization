<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .nav {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .user-info {
            color: white;
            font-weight: 500;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 3rem;
            color: white;
            font-weight: bold;
        }

        .profile-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .profile-subtitle {
            color: #666;
            font-size: 1.1rem;
        }

        .profile-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            background: #f8f9ff;
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .info-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 1.1rem;
            color: #333;
            font-weight: 500;
        }

        .actions-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .actions-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #333;
            border: 2px solid #e9ecef;
        }

        .btn-secondary:hover {
            background: #e9ecef;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-1px);
        }

        .stats-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .stats-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            background: #f8f9ff;
            border-radius: 10px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 1rem;
            }

            .container {
                padding: 1rem;
            }

            .profile-info {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">Система авторизации</div>
        <nav class="nav">
            <span class="user-info">Привет, {{ $user->name }}!</span>
            <a href="{{ route('home') }}">Главная</a>
            <a href="{{ route('logout') }}">Выйти</a>
        </nav>
    </header>

    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h1 class="profile-title">{{ $user->name }}</h1>
                <p class="profile-subtitle">Пользователь системы</p>
            </div>

            <div class="profile-info">
                <div class="info-item">
                    <div class="info-label">Полное имя</div>
                    <div class="info-value">{{ $user->name }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Email адрес</div>
                    <div class="info-value">{{ $user->email }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Дата регистрации</div>
                    <div class="info-value">{{ $user->created_at ? $user->created_at->format('d.m.Y') : 'Не указана' }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Последнее обновление</div>
                    <div class="info-value">{{ $user->updated_at ? $user->updated_at->format('d.m.Y H:i') : 'Не указано' }}</div>
                </div>
            </div>
        </div>

        <div class="stats-section">
            <h2 class="stats-title">Статистика аккаунта</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">1</div>
                    <div class="stat-label">Активных сессий</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $user->created_at ? $user->created_at->diffInDays(now()) : 0 }}</div>
                    <div class="stat-label">Дней с нами</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">✓</div>
                    <div class="stat-label">Аккаунт активен</div>
                </div>
            </div>
        </div>

        <div class="actions-card">
            <h2 class="actions-title">Действия</h2>
            <div class="action-buttons">
                <a href="{{ route('home') }}" class="btn btn-primary">
                    🏠 Вернуться на главную
                </a>
                <button type="button" class="btn btn-secondary" onclick="alert('Функция редактирования в разработке')">
                    ✏️ Редактировать профиль
                </button>
                <button type="button" class="btn btn-secondary" onclick="alert('Функция смены пароля в разработке')">
                    🔒 Сменить пароль
                </button>
                <a href="{{ route('logout') }}" class="btn btn-danger" onclick="return confirm('Вы действительно хотите выйти из системы?')">
                    🚪 Выйти из системы
                </a>
            </div>
        </div>
    </div>
</body>
</html>
