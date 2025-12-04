<x-header></x-header>
<div class="app-layout">
    <!-- Sidebar -->
   <x-sidebar></x-sidebar>
    <!-- Main Content -->
    <main class="main-content">
        <x-navbar></x-navbar>

        <div class="dashboard-content">
            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">📚</div>
                    <div class="stat-info">
                        <div class="stat-label">Total Quizzes</div>
                        <div class="stat-value">12</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">✅</div>
                    <div class="stat-info">
                        <div class="stat-label">Quizzes Taken</div>
                        <div class="stat-value">8</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">🎯</div>
                    <div class="stat-info">
                        <div class="stat-label">Average Score</div>
                        <div class="stat-value">85%</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">🔥</div>
                    <div class="stat-info">
                        <div class="stat-label">Current Streak</div>
                        <div class="stat-value">5 days</div>
                    </div>
                </div>
            </section>

            <section class="recent-section">
                <div class="section-header">
                    <h3>Recent Quizzes</h3>
                    <a href="my-quizzes.html" class="link-secondary">View All</a>
                </div>
                <div class="quiz-list">
                    <div class="quiz-item">
                        <div class="quiz-info">
                            <h4>JavaScript Basics</h4>
                            <p>10 questions • Created 2 days ago</p>
                        </div>
                        <div class="quiz-actions">
                            <button class="btn btn-small btn-secondary">Edit</button>
                            <button class="btn btn-small btn-primary">Take Quiz</button>
                        </div>
                    </div>
                    <div class="quiz-item">
                        <div class="quiz-info">
                            <h4>Web Development</h4>
                            <p>15 questions • Created 5 days ago</p>
                        </div>
                        <div class="quiz-actions">
                            <button class="btn btn-small btn-secondary">Edit</button>
                            <button class="btn btn-small btn-primary">Take Quiz</button>
                        </div>
                    </div>
                    <div class="quiz-item">
                        <div class="quiz-info">
                            <h4>CSS Styling</h4>
                            <p>8 questions • Created 1 week ago</p>
                        </div>
                        <div class="quiz-actions">
                            <button class="btn btn-small btn-secondary">Edit</button>
                            <button class="btn btn-small btn-primary">Take Quiz</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

<script>
    document.querySelector('.logout-btn').addEventListener('click', function() {
        window.location.href = 'index.html';
    });
</script>
</body>
</html>
