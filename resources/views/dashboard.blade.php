<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizMaster - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #ffffff;
            color: #1e293b;
            line-height: 1.6;
            min-height: 100vh;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Yangi topbar dizayni - dropdown profile */
        .main-content {
            flex: 1;
            margin-left: 250px;
            display: flex;
            flex-direction: column;
        }


        /* Admin Section - o'zgarishsiz */
        .admin-section {
            flex: 1;
            padding: 24px;
        }

        .stats-row {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            flex: 1;
            text-align: center;
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: 700;
            color: #3b82f6;
        }

        .stat-card .label {
            font-size: 14px;
            color: #64748b;
        }

        .search-box {
            margin-bottom: 24px;
        }

        .search-box input {
            width: 100%;
            max-width: 300px;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }

        .search-box input:focus {
            border-color: #3b82f6;
        }

        .table-container {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #f1f5f9;
            font-weight: 600;
            font-size: 13px;
            color: #64748b;
            text-transform: uppercase;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #f1f5f9;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #3b82f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
        }

        .user-name {
            font-weight: 600;
            color: #1e293b;
        }

        .score-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .score-high {
            background: #dcfce7;
            color: #166534;
        }

        .score-medium {
            background: #fef9c3;
            color: #854d0e;
        }

        .score-low {
            background: #fee2e2;
            color: #991b1b;
        }

        .quiz-name {
            color: #64748b;
            font-size: 14px;
        }

        .date {
            color: #64748b;
            font-size: 14px;
        }

        footer {
            background: #f8fafc;
            padding: 16px 24px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        footer p {
            color: #64748b;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; }
            .stats-row { flex-direction: column; }
            .table-container { overflow-x: auto; }
            table { min-width: 600px; }
            .profile-name { display: none; }
        }
    </style>
</head>
<body>
<div class="admin-layout">
    <!-- Yangi sidebar - emoji ikonkali -->
    <x-sidebar></x-sidebar>
    <div class="main-content">
        <!-- Yangi topbar - dropdown bilan -->
        <x-navbar></x-navbar>

        <section class="admin-section">
            <div class="stats-row">

                <div class="stat-card">
                    <div class="number" id="totalAttempts">342</div>
                    <div class="label">Yechilgan quizlar</div>
                </div>
                <div class="stat-card">
                    <div class="number" id="avgProgress">78%</div>
                    <div class="label">O'rtacha natija</div>
                </div>
            </div>

{{--            <div class="search-box">--}}
{{--                <input type="text" placeholder="Ism yoki familya bo'yicha qidirish...">--}}
{{--            </div>--}}

            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>Foydalanuvchi</th>
                        <th>Quiz nomi</th>
                        <th>Natija</th>
                        <th>Sana</th>
                    </tr>
                    </thead>
                    <tbody id="attempts-tbody">
                    <tr>
                        <td>

                        </td>
                       
                    </tbody>
                </table>
            </div>
        </section>

        <footer>
            <p>© 2025 QuizMaster. Barcha huquqlar himoyalangan.</p>
        </footer>
    </div>
</div>

<!-- Dropdown toggle script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const profileBtn = document.getElementById('profileBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');

        if (profileBtn && dropdownMenu) {
            profileBtn.addEventListener('click', () => {
                dropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }
        const token = localStorage.getItem('token');
        async function loadAttempts() {
            try {
                const res = await fetch('/api/attempt-answers', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}` // token mavjud bo‘lsa
                    }
                })
                const data = await res.json();

                const quizRes = await fetch('/api/quizzes', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    }
                });

                const quizData = await quizRes.json();
                const quizzes = quizData.quizzes; // <-- shu yerda array olinadi
                const quizMap = {};
                quizzes.forEach(q => { quizMap[q.id] = q.title; });

                const tbody = document.getElementById('attempts-tbody');
                tbody.innerHTML = '';

                data.attempts.forEach(attempt => {
                    const nameParts = attempt.full_name.split(' ');
                    const avatar = (nameParts[0][0] + (nameParts[1]?.[0] || '')).toUpperCase();

                    const total = attempt.total_questions || 1;
                    console.log(attempt.correct_answers_count)
                    const percentage = Math.round((attempt.correct_answers_count / total) * 100);
                    let badgeClass = 'score-low';
                    if (percentage >= 85) badgeClass = 'score-high';
                    else if (percentage >= 60) badgeClass = 'score-medium';

                    const date = new Date(attempt.created_at);
                    const formattedDate = date.toLocaleDateString('uz-UZ', { day: '2-digit', month: '2-digit', year: 'numeric' });

                    const quizTitle = quizMap[attempt.quiz_id] || "Noma'lum quiz";

                    tbody.innerHTML += `
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="avatar">${avatar}</div>
                                <span class="user-name">${attempt.full_name}</span>
                            </div>
                        </td>
                        <td class="quiz-name">${quizTitle}</td>
                        <td><span class="score-badge ${badgeClass}">${percentage}%</span></td>
                        <td class="date">${formattedDate}</td>
                    </tr>
                `;
                });
            } catch (error) {
                console.error('API dan ma\'lumot olishda xatolik:', error);
            }
        }

        loadAttempts();
        loadAttempt();
    });

    const token = localStorage.getItem('token');
    async function loadAttempt() {
        try {
            const res = await fetch('/api/attempts', {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}` // token mavjud bo‘lsa
                }
            })
            const data = await res.json();
            console.log(data);
            // HTML elementlarni tanlash
            const totalAttemptsEl = document.getElementById('totalAttempts');
            const avgProgressEl = document.getElementById('avgProgress');

            // API dan olingan ma'lumotlarni chiqarish
            totalAttemptsEl.textContent = data.count;       // Yechilgan quizlar soni
            avgProgressEl.textContent = data.progress;     // Progress, masalan "3%"


        }catch (error) {
        console.error('API dan ma\'lumot olishda xatolik:', error);}
    }
</script>

</body>
</html>
