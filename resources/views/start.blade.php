    <!DOCTYPE html>
    <html lang="uz">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>QuizMaster - Boshlash</title>
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

            /* Form Section */
            .form-section {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 60px 20px;
            }

            .form-card {
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                padding: 40px;
                width: 100%;
                max-width: 420px;
                text-align: center;
            }

            .form-icon {
                font-size: 48px;
                margin-bottom: 16px;
            }

            .form-card h1 {
                font-size: 24px;
                margin-bottom: 8px;
                color: #1e293b;
            }

            .form-card p {
                color: #64748b;
                font-size: 14px;
                margin-bottom: 32px;
            }

            .form-group {
                margin-bottom: 20px;
                text-align: left;
            }

            .form-group label {
                display: block;
                font-size: 14px;
                font-weight: 500;
                color: #1e293b;
                margin-bottom: 8px;
            }

            .form-group input {
                width: 100%;
                padding: 12px 16px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 16px;
                background: #ffffff;
                color: #1e293b;
                transition: border-color 0.3s, box-shadow 0.3s;
            }

            .form-group input:focus {
                outline: none;
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            }

            .form-group input::placeholder {
                color: #94a3b8;
            }

            .submit-btn {
                width: 100%;
                padding: 14px;
                background: #3b82f6;
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: background 0.3s;
                margin-top: 12px;
            }

            .submit-btn:hover {
                background: #2563eb;
            }

            .back-link {
                display: inline-block;
                margin-top: 24px;
                color: #64748b;
                text-decoration: none;
                font-size: 14px;
                transition: color 0.3s;
            }

            .back-link:hover {
                color: #3b82f6;
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
                .form-card { padding: 30px 24px; }
            }
        </style>
    </head>
    <body>
    <!-- Header -->
    <x-home-navbar></x-home-navbar>


    <!-- Form Section -->
    <section class="form-section">
        <div class="form-card">
            <div class="form-icon">👤</div>
            <h1>Quizni boshlash</h1>
            <p>Quizni boshlash uchun ismingizni kiriting</p>

            <!-- Formani POST qilish uchun action va method qo'shildi -->
            <form id="startQuizForm" method="post">
                <div class="form-group">
                    <label for="full_name">Ism va Familya</label>
                    <input type="text" id="full_name" name="full_name" placeholder="Ismingiz va familyangizni kiriting" required>
                </div>

                <button type="submit" class="submit-btn">Davom etish</button>
            </form>

            <a href="/quizzes" class="back-link">← Quizlarga qaytish</a>
        </div>
    </section>
    <!-- Footer -->
    <footer>
        <div class="container">
            <p>© 2025 QuizMaster. Barcha huquqlar himoyalangan.</p>
        </div>
    </footer>

    <script>
        const form = document.getElementById('startQuizForm');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const fullName = form.full_name.value; // encodeURIComponent keraksiz, POST body JSON bo'ladi

            // Hozirgi URL: http://127.0.0.1:8000/quiz/4/start
            const urlParts = window.location.pathname.split('/');
            const quizId = urlParts[2]; // 0 = '', 1 = 'quiz', 2 = '4', 3 = 'start'

            try {
                const response = await fetch(`/api/quiz/${quizId}/start`, {
                    method: 'POST', // POST method
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json', // JSON body uchun
                        // Agar CSRF token kerak bo'lsa, Blade faylda qo'shishingiz mumkin
                        // 'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ full_name: fullName })
                });

                const data = await response.json();
                console.log(data);

                if (response.ok) {
                    // alert(446);
                    // Muvaffaqiyatli bo'lsa, quiz sahifasiga yo'naltirish
                    window.location.href = `/take-quiz/${quizId}?attempt_id=${data.attempt_id}`;
                } else {
                    alert(data.message || 'Xatolik yuz berdi');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Server bilan bog‘lanishda xatolik yuz berdi');
            }
        });
    </script>


    </body>
    </html>
