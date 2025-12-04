<x-header></x-header>
<div class="app-layout">
    <!-- Sidebar -->
    <x-sidebar></x-sidebar>

    <!-- Main Content -->
    <main class="main-content">
        <x-navbar></x-navbar>


        <div class="quizzes-content">
            <div class="filters">
                <button class="filter-btn active">All</button>
                <button class="filter-btn">Created by me</button>
                <button class="filter-btn">Published</button>
            </div>

            <div class="quizzes-grid">
                <div class="quiz-card">
                    <div class="quiz-card-header">
                        <h3>JavaScript Fundamentals</h3>
                        <span class="quiz-badge">10 Qs</span>
                    </div>
                    <p class="quiz-desc">Master the basics of JavaScript programming</p>
                    <div class="quiz-meta">
                        <span>Created: 2 days ago</span>
                        <span class="quiz-status">Published</span>
                    </div>
                    <div class="quiz-card-actions">
                        <button class="btn btn-small btn-secondary">Edit</button>
                        <button class="btn btn-small btn-secondary">Delete</button>
                        <button class="btn btn-small btn-primary">Take</button>
                    </div>
                </div>

                <div class="quiz-card">
                    <div class="quiz-card-header">
                        <h3>Web Development 101</h3>
                        <span class="quiz-badge">15 Qs</span>
                    </div>
                    <p class="quiz-desc">Learn the fundamentals of web development</p>
                    <div class="quiz-meta">
                        <span>Created: 5 days ago</span>
                        <span class="quiz-status">Published</span>
                    </div>
                    <div class="quiz-card-actions">
                        <button class="btn btn-small btn-secondary">Edit</button>
                        <button class="btn btn-small btn-secondary">Delete</button>
                        <button class="btn btn-small btn-primary">Take</button>
                    </div>
                </div>

                <div class="quiz-card">
                    <div class="quiz-card-header">
                        <h3>CSS Styling Guide</h3>
                        <span class="quiz-badge">8 Qs</span>
                    </div>
                    <p class="quiz-desc">Deep dive into CSS styling techniques</p>
                    <div class="quiz-meta">
                        <span>Created: 1 week ago</span>
                        <span class="quiz-status">Draft</span>
                    </div>
                    <div class="quiz-card-actions">
                        <button class="btn btn-small btn-secondary">Edit</button>
                        <button class="btn btn-small btn-secondary">Delete</button>
                        <button class="btn btn-small btn-secondary">Publish</button>
                    </div>
                </div>

                <div class="quiz-card">
                    <div class="quiz-card-header">
                        <h3>React Hooks Advanced</h3>
                        <span class="quiz-badge">12 Qs</span>
                    </div>
                    <p class="quiz-desc">Advanced React concepts and patterns</p>
                    <div class="quiz-meta">
                        <span>Created: 10 days ago</span>
                        <span class="quiz-status">Published</span>
                    </div>
                    <div class="quiz-card-actions">
                        <button class="btn btn-small btn-secondary">Edit</button>
                        <button class="btn btn-small btn-secondary">Delete</button>
                        <button class="btn btn-small btn-primary">Take</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    document.querySelector('.logout-btn').addEventListener('click', function() {
        window.location.href = 'index.html';
    });

    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
</body>
</html>
