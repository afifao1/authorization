<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .welcome-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 2rem;
        }

        .welcome-title {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .welcome-text {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .stat-title {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .stat-desc {
            color: #666;
            font-size: 0.9rem;
        }

        .features-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .features-title {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 600;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .feature-item {
            padding: 1.5rem;
            border-left: 4px solid #667eea;
            background: #f8f9ff;
            border-radius: 8px;
        }

        .feature-item h3 {
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .feature-item p {
            color: #666;
            line-height: 1.6;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 1rem;
            }

            .container {
                padding: 1rem;
            }

            .welcome-title {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">Система авторизации</div>
        <nav class="nav">
            <span class="user-info">Привет, {{ $user->name }}!</span>
            <a href="{{ route('profile') }}">Профиль</a>
            <a href="{{ route('logout') }}">Выйти</a>
        </nav>
    </header>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="welcome-card">
            <h1 class="welcome-title">Добро пожаловать, {{ $user->name }}! 🎉</h1>
            <p class="welcome-text">Вы успешно авторизованы в системе. Теперь у вас есть доступ ко всем функциям!</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">👤</div>
                <div class="stat-title">Ваш профиль</div>
                <div class="stat-desc">Управляйте своими данными и настройками</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🔐</div>
                <div class="stat-title">Безопасность</div>
                <div class="stat-desc">Ваши данные защищены современным шифрованием</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📱</div>
                <div class="stat-title">Адаптивность</div>
                <div class="stat-desc">Работает на всех устройствах и экранах</div>
            </div>
        </div>

        <div class="features-section">
            <h2 class="features-title">Возможности системы</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <h3>🚀 Быстрая авторизация</h3>
                    <p>Мгновенный вход в систему с запоминанием учетных данных</p>
                </div>
                <div class="feature-item">
                    <h3>🛡️ Защищенные данные</h3>
                    <p>Все пароли хешируются, сессии защищены от атак</p>
                </div>
                <div class="feature-item">
                    <h3>📊 Управление профилем</h3>
                    <p>Полный контроль над своими данными и настройками</p>
                </div>
                <div class="feature-item">
                    <h3>🔄 Автоматический выход</h3>
                    <p>Безопасное завершение сессии одним кликом</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
