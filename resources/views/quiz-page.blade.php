<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizMaster - Quizlar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Orqa fon oq rangga o'zgartirildi */
            background: #ffffff;
            color: #1e293b;
            line-height: 1.6;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            /* Header rangini oq temaga moslashtirildi */
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
            /* Link ranglari oq temaga moslashtirildi */
            color: #64748b;
            text-decoration: none;
            margin-left: 24px;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #3b82f6;
        }

        /* Hero */
        .hero {
            text-align: center;
            padding: 60px 0 40px;
        }

        .hero h1 {
            font-size: 36px;
            margin-bottom: 12px;
            color: #1e293b;
        }

        .hero h1 span {
            color: #3b82f6;
        }

        .hero p {
            /* Matn rangini oq temaga moslashtirildi */
            color: #64748b;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Quizlar bo'limi */
        .quizzes {
            padding: 40px 0 60px;
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 24px;
            text-align: center;
            color: #1e293b;
        }

        .quiz-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .quiz-card {
            /* Karta rangini oq temaga moslashtirildi */
            background: #f8fafc;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .quiz-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .quiz-header {
            padding: 24px;
            text-align: center;
        }

        .quiz-icon {
            font-size: 40px;
            margin-bottom: 8px;
        }

        .quiz-category {
            display: inline-block;
            background: rgba(255,255,255,0.3);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            color: white;
        }

        .quiz-body {
            padding: 20px 24px 24px;
        }

        .quiz-title {
            font-size: 18px;
            margin-bottom: 8px;
            color: #1e293b;
        }

        .quiz-desc {
            /* Tavsif matn rangini oq temaga moslashtirildi */
            color: #64748b;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .quiz-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            font-size: 14px;
            color: #1e293b;
        }

        .quiz-questions {
            color: #64748b;
        }

        .difficulty {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
        }

        .easy { background: #166534; color: #86efac; }
        .medium { background: #a16207; color: #fde047; }
        .hard { background: #991b1b; color: #fca5a5; }

        .quiz-btn {
            display: block;
            text-align: center;
            background: #3b82f6;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
        }

        .quiz-btn:hover {
            background: #2563eb;
        }

        /* Footer */
        footer {
            /* Footer rangini oq temaga moslashtirildi */
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
            .hero h1 { font-size: 28px; }
            .quiz-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<!-- Header -->
<x-home-navbar></x-home-navbar>


<!-- Hero -->
<section class="hero">
    <div class="container">
        <h1>Bilimingizni <span>Sinang</span></h1>
        <p>Turli mavzularda o'z bilimingizni tekshiring va yangi narsalarni o'rganing</p>
    </div>
</section>

<!-- Quizlar -->
<section class="quizzes">
    <div class="container">
        <h2 class="section-title">Mavjud Quizlar</h2>

        <div class="quiz-grid" id="quiz-grid">
            <!-- Quiz 1 -->
            <div class="quiz-card">

            </div>

        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <p>© 2025 QuizMaster. Barcha huquqlar himoyalangan.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetchQuizzes();
    });

    async function fetchQuizzes() {
        try {
            const response = await axios.get("/api/all-quizzes");

            const quizzes = response.data.quizzes;
            const quizGrid = document.getElementById("quiz-grid");

            quizGrid.innerHTML = ""; // Avvalgi kartochkalarni tozalaymiz

            quizzes.forEach(q => {

                const card = `
                <div class="quiz-card">
                    <div class="quiz-header" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
                        <div class="quiz-icon"> <img src="${q.icon_url}" alt="Quiz Icon" width="36"></div>
                        <span class="quiz-category">${q.title}</span>
                    </div>

                    <div class="quiz-body">
                        <h3 class="quiz-title">${q.title}</h3>
                        <p class="quiz-desc">${q.description}</p>

                        <div class="quiz-info">
                            <span class="quiz-questions">${q.questions_count} savol</span>
                            <span class="difficulty easy">Oson</span>
                        </div>

                        <a href="/quiz/${q.id}/start" class="quiz-btn">Boshlash</a>
                    </div>
                </div>
            `;

                quizGrid.innerHTML += card;
            });

        } catch (error) {
            console.error("Xatolik:", error);
        }
    }
</script>

</body>
</html>
