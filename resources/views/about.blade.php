<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biz haqimizda - QuizMaster</title>
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

        /* Hero */
        .hero {
            text-align: center;
            padding: 60px 0 40px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .hero p {
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0.9;
        }

        /* About Content */
        .about-content {
            padding: 60px 0;
        }

        .about-section {
            margin-bottom: 60px;
        }

        .about-section h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #1e293b;
        }

        .about-section p {
            font-size: 16px;
            color: #64748b;
            margin-bottom: 16px;
            line-height: 1.8;
        }

        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .feature-card {
            background: #f8fafc;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #e2e8f0;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .feature-card h3 {
            font-size: 20px;
            margin-bottom: 12px;
            color: #1e293b;
        }

        .feature-card p {
            font-size: 14px;
            color: #64748b;
        }

        /* Stats Section */
        .stats-section {
            background: #f8fafc;
            padding: 60px 0;
            margin: 60px 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            text-align: center;
        }

        .stat-item h3 {
            font-size: 48px;
            color: #3b82f6;
            margin-bottom: 8px;
        }

        .stat-item p {
            font-size: 16px;
            color: #64748b;
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
            .hero h1 { font-size: 32px; }
            .about-section h2 { font-size: 24px; }
            .stat-item h3 { font-size: 36px; }
        }
    </style>
</head>
<body>
<!-- Header -->
<x-home-navbar></x-home-navbar>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <h1>Biz haqimizda</h1>
        <p>QuizMaster - bu bilimingizni sinash va yangi narsalarni o'rganish uchun eng yaxshi platforma</p>
    </div>
</section>

<!-- About Content -->
<section class="about-content">
    <div class="container">
        <div class="about-section">
            <h2>Bizning Maqsadimiz</h2>
            <p>
                QuizMaster platformasi orqali biz o'quvchi va talabalarning bilim darajasini oshirish,
                o'z bilimlarini sinash va yangi mavzularni qiziqarli tarzda o'rganishlariga yordam berishni maqsad qilganmiz.
            </p>
            <p>
                Bizning platformamiz turli xil mavzularda quizlarni taqdim etadi - matematika, tarix,
                fan, geografiya, tillar va texnologiya sohalarida. Har bir quiz professional pedagoglar
                tomonidan tayyorlangan va bilim darajangizni aniq baholash uchun mo'ljallangan.
            </p>
        </div>

        <div class="about-section">
            <h2>Nima uchun QuizMaster?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📚</div>
                    <h3>Keng Mavzular</h3>
                    <p>Matematikadan tortib ingliz tiligacha, ko'plab mavzularda quizlar</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3>Turli Qiyinlik Darajalari</h3>
                    <p>Oson, o'rta va qiyin darajadagi savollar sizning darajangizga mos</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Natijalarni Kuzatish</h3>
                    <p>O'z natijalaringizni ko'ring va taraqqiyotingizni kuzatib boring</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Tez va Qulay</h3>
                    <p>Oddiy interfeys va tez ishlash - quizlar hal qilish zavqli</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🏆</div>
                    <h3>Motivatsiya</h3>
                    <p>Natijalaringiz va muvaffaqiyatlaringiz uchun mukofotlar</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔄</div>
                    <h3>Doimiy Yangilanish</h3>
                    <p>Muntazam yangi quizlar va mavzular qo'shib boriladi</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <h3>1000+</h3>
                <p>Faol foydalanuvchilar</p>
            </div>
            <div class="stat-item">
                <h3>50+</h3>
                <p>Turli mavzulardagi quizlar</p>
            </div>
            <div class="stat-item">
                <h3>5000+</h3>
                <p>Yechilgan quizlar</p>
            </div>
            <div class="stat-item">
                <h3>4.8/5</h3>
                <p>O'rtacha baho</p>
            </div>
        </div>
    </div>
</section>

<section class="about-content">
    <div class="container">
        <div class="about-section">
            <h2>Biz bilan bog'laning</h2>
            <p>
                Savollaringiz yoki takliflaringiz bo'lsa, biz bilan bog'lanishdan tortinmang.
                Biz har doim platformamizni yaxshilash va foydalanuvchilarimizning ehtiyojlarini
                qondirish uchun harakat qilamiz.
            </p>
            <p style="margin-top: 20px;">
                <strong>Email:</strong> info@quizmaster.uz<br>
                <strong>Telefon:</strong> +998 90 123 45 67
            </p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; 2025 QuizMaster. Barcha huquqlar himoyalangan.</p>
    </div>
</footer>
</body>
</html>
