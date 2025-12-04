<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz - QuizMaster</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .no-sidebar .main-content {
            margin-left: 0;
            width: 100%;
        }

        .full-width {
            width: 100%;
        }

    </style>
</head>
<body>

<div class="app-layout no-sidebar">
    <!-- Main Content -->
    <main class="main-content full-width">
        <nav class="topbar">
            <div class="topbar-left">
                <h2>JavaScript Fundamentals</h2>
            </div>
            <div class="topbar-right">
                <div class="quiz-timer">
                    <span class="timer-icon">⏱️</span>
                    <span class="timer-value">15:32</span>
                </div>
            </div>
        </nav>

        <div class="quiz-content">

            <div class="quiz-progress">
                <div class="progress-info">
                    <span>Question 3 of 10</span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 30%;"></div>
                    </div>
                </div>
            </div>

            <div class="question-container">
                <div class="question-header">
                    <h3>What is the output of this JavaScript code?</h3>
                    <code class="code-block">console.log(typeof undefined)</code>
                </div>

                <div class="options-container">
                    <label class="option">
                        <input type="radio" name="question3" value="a">
                        <span class="option-label">"undefined"</span>
                    </label>
                    <label class="option">
                        <input type="radio" name="question3" value="b">
                        <span class="option-label">undefined</span>
                    </label>
                    <label class="option">
                        <input type="radio" name="question3" value="c">
                        <span class="option-label">"object"</span>
                    </label>
                    <label class="option">
                        <input type="radio" name="question3" value="d">
                        <span class="option-label">null</span>
                    </label>
                </div>
            </div>

            <div class="quiz-navigation">
                <button class="btn btn-secondary">← Previous</button>

                <div class="question-indicators">
                    <button class="indicator active" data-q="1">1</button>
                    <button class="indicator" data-q="2">2</button>
                    <button class="indicator" data-q="3">3</button>
                    <button class="indicator" data-q="4">4</button>
                    <button class="indicator" data-q="5">5</button>
                </div>

                <button class="btn btn-primary">Next →</button>
            </div>

            <div class="quiz-actions">
                <button class="btn btn-secondary">Exit Quiz</button>
                <button class="btn btn-primary">Submit Quiz</button>
            </div>

        </div>
    </main>
</div>

<script>

    // Submit
    document.querySelectorAll('.btn-primary').forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.textContent.includes('Submit')) {
                alert('Quiz submitted! Check your results.');
                window.location.href = 'my-quizzes.html';
            }
        });
    });

    // Indicators
    document.querySelectorAll('.indicator').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.indicator').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

</body>
</html>
