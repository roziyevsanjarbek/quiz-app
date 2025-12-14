<aside class="sidebar">
    <div class="sidebar-header">
        <span class="logo-icon">📚</span>
        <span class="logo-text">QuizMaster</span>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="nav-icon">🏠</span>
            <span class="nav-label">Dashboard</span>
        </a>

        <a href="{{ route('my-quizzes') }}" class="nav-item {{ request()->routeIs('my-quizzes') ? 'active' : '' }}">
            <span class="nav-icon">📋</span>
            <span class="nav-label">My Quizzes</span>
        </a>

        <a href="{{ route('subject') }}" class="nav-item {{ request()->routeIs('subject') ? 'active' : '' }}">
            <span class="menu-icon">📝</span>
            <span class="menu-text">Quiz Icon</span>
        </a>

        <a href="{{ route('add-quizzes') }}" class="nav-item {{ request()->routeIs('add-quizzes') ? 'active' : '' }}">
            <span class="nav-icon">✍️</span>
            <span class="nav-label">Create Quiz</span>
        </a>
        <a href="{{ route('upload-quiz') }}" class="nav-item {{ request()->routeIs('upload-quiz') ? 'active' : '' }}">
            <span class="nav-icon">⬆️</span>
            <span class="nav-label">Fayl Yuklash</span>
        </a>
    </nav>
</aside>
