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
            <h1>Master Your Knowledge</h1>
            <p>Create, share, and solve interactive quizzes. Learn smarter, not harder.</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-large">Get Started</a>
        </div>
        <div class="hero-features">
            <div class="feature-card">
                <div class="feature-icon">✨</div>
                <h3>Create Quizzes</h3>
                <p>Build custom quizzes with multiple question types</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Take Tests</h3>
                <p>Challenge yourself with interactive quizzes</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Track Progress</h3>
                <p>Monitor your learning journey with detailed analytics</p>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2025 QuizMaster. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
