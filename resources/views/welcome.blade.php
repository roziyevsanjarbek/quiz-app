<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizMaster - Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<!-- Welcome Page -->
<div class="welcome-page">
    <nav class="navbar">
        <div class="navbar-container">
            <div class="logo">
                <span class="logo-icon">📚</span>
                <span class="logo-text">QuizMaster</span>
            </div>
            <div class="nav-links">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            </div>
        </div>
    </nav>

    <main class="welcome-hero">
        <div class="hero-content">
            <h1>O'z bilimlaringizni o'zlashtiring</h1>
            <p>Interaktiv viktorinalarni yarating, baham ko'ring va hal qiling. Aqlliroq o'rganing, qiyinroq emas.</p>
            <a href="/quizzes" class="btn btn-primary btn-large">Savollar</a>
        </div>
        <div class="hero-features">
            <div class="feature-card">
                <div class="feature-icon">✨</div>
                <h3>Viktorinalar yaratish</h3>
                <p>Bir nechta savol turlari bilan maxsus viktorinalar yarating</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Testlarni topshiring</h3>
                <p>Interaktiv viktorinalar bilan o'zingizni sinab ko'ring</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Jarayonni kuzatish</h3>
                <p>Batafsil tahlillar yordamida o'rganish sayohatingizni kuzatib boring</p>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2025 QuizMaster. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
