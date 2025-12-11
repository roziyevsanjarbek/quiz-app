<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizMaster - Natija</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ffffff;
            color: #1e293b;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background: #f8fafc;
            padding: 16px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #3b82f6;
            text-decoration: none;
        }

        nav a {
            color: #64748b;
            text-decoration: none;
            margin-left: 24px;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #3b82f6;
        }

        /* Result Section */
        .result-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
        }

        .result-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 480px;
            text-align: center;
        }

        .result-icon {
            font-size: 64px;
            margin-bottom: 16px;
        }

        .result-card h1 {
            font-size: 24px;
            margin-bottom: 8px;
            color: #1e293b;
        }

        .user-name {
            color: #3b82f6;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        /* Score Circle */
        .score-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: white;
        }

        .score-number {
            font-size: 42px;
            font-weight: 700;
            line-height: 1;
        }

        .score-label {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Stats */
        .stats {
            display: flex;
            justify-content: center;
            gap: 32px;
            margin-bottom: 32px;
            padding: 20px 0;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
        }

        .stat-value.correct {
            color: #22c55e;
        }

        .stat-value.wrong {
            color: #ef4444;
        }

        .stat-label {
            font-size: 13px;
            color: #64748b;
        }

        /* Message */
        .result-message {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 24px;
        }

        /* Buttons */
        .btn-group {
            display: flex;
            gap: 12px;
        }

        .btn {
            flex: 1;
            padding: 14px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: #ffffff;
            color: #1e293b;
            border: 1px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #f1f5f9;
        }

        /* Footer */
        footer {
            background: #f8fafc;
            padding: 24px 0;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        footer p {
            color: #64748b;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            nav { display: none; }
            .result-card { padding: 30px 24px; }
            .stats { gap: 20px; }
            .btn-group { flex-direction: column; }
        }
    </style>
</head>
<body>
<!-- Header -->
<x-home-navbar></x-home-navbar>

<!-- Result Section -->
<section class="result-section">
    <div class="result-card">
        <div class="result-icon">🏆</div>
        <h1>Quiz yakunlandi!</h1>
        <p class="user-name">Alisher Karimov</p>

        <div class="score-circle">
            <span class="score-number">85%</span>
            <span class="score-label">natija</span>
        </div>

        <div class="stats">
            <div class="stat-item">
                <div class="stat-value correct">17</div>
                <div class="stat-label">To'g'ri</div>
            </div>
            <div class="stat-item">
                <div class="stat-value wrong">3</div>
                <div class="stat-label">Noto'g'ri</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">20</div>
                <div class="stat-label">Jami</div>
            </div>
        </div>

        <div class="result-message">
            Ajoyib natija! Siz quizni muvaffaqiyatli yakunladingiz.
        </div>

        <div class="btn-group">
            <a href="/quizzes" class="btn btn-primary">Savollar</a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <p>© 2025 QuizMaster. Barcha huquqlar himoyalangan.</p>
    </div>
</footer>
</body>
</html>
<script>
    const params = new URLSearchParams(window.location.search);
    const attemptId = params.get("attempt_id"); // misol: 16
    async function fetchQuizResult() {
        try {
            const res = await fetch(`/api/quiz/finish`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    attempt_id: attemptId
                })
            });

            const data = await res.json();
            console.log(data);
            renderResult(data);

        } catch (err) {
            console.error("Natijani olishda xatolik:", err);
        }
    }
    function renderResult(data) {
        // Foydalanuvchi ismi
        document.querySelector('.user-name').textContent = data.full_name;

        // Score
        document.querySelector('.score-number').textContent = `${data.percentage}%`;

        // Stats
        document.querySelector('.stat-value.correct').textContent = data.correct;
        document.querySelector('.stat-value.wrong').textContent = data.total - data.correct;
        document.querySelector('.stats .stat-item:nth-child(3) .stat-value').textContent = data.total;

        // Message
        const msgEl = document.querySelector('.result-message');
        if (data.percentage >= 80) {
            msgEl.textContent = "Ajoyib natija! Siz quizni muvaffaqiyatli yakunladingiz.";
            msgEl.style.background = "#f0fdf4";
            msgEl.style.border = "1px solid #bbf7d0";
            msgEl.style.color = "#166534";
        } else if (data.percentage >= 50) {
            msgEl.textContent = "Yaxshi natija! Lekin yanada yaxshilash mumkin.";
            msgEl.style.background = "#fefce8";
            msgEl.style.border = "1px solid #fde68a";
            msgEl.style.color = "#78350f";
        } else {
            msgEl.textContent = "Qiyin bo‘ldi. Keyingi safar yaxshiroq harakat qilamiz!";
            msgEl.style.background = "#fef2f2";
            msgEl.style.border = "1px solid #fecaca";
            msgEl.style.color = "#991b1b";
        }
    }
    document.addEventListener('DOMContentLoaded', () => {
        if(attemptId) {
            fetchQuizResult();
        } else {
            console.error("Attempt ID topilmadi!");
        }
    });

</script>
