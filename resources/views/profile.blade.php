<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizMaster - Profile</title>
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
        }

        /* Sidebar olib tashlandi, oddiy layout */
        .admin-layout {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Topbar */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 24px;
            background: #ffffff;
            border-bottom: 1px solid #e5e5e5;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon { font-size: 28px; }
        .logo-text { font-size: 20px; font-weight: 700; color: #3b82f6; }

        .topbar-right { position: relative; }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .profile-avatar {
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

        .profile-name { font-weight: 500; color: #1e293b; }

        .dropdown-menu {
            position: absolute;
            top: 50px;
            right: 0;
            width: 160px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            padding: 8px 0;
            z-index: 999;
        }

        .dropdown-item {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }

        .dropdown-item:hover { background: #f3f3f3; }
        .logout { color: #d00; }
        .hidden { display: none; }

        /* Profile Section */
        .profile-section {
            flex: 1;
            padding: 24px;
        }

        .profile-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 32px;
            max-width: 600px;
            margin: 0 auto;
        }

        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        .profile-avatar-large {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #3b82f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 36px;
            margin-bottom: 16px;
        }

        .profile-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .profile-header p {
            color: #64748b;
            font-size: 14px;
        }

        .profile-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #475569;
        }

        .form-group input {
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #3b82f6;
        }

        .form-row {
            display: flex;
            gap: 16px;
        }

        .form-row .form-group { flex: 1; }

        .btn-save {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 12px;
        }

        .btn-save:hover { background: #2563eb; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
        }

        .stat-item {
            text-align: center;
            padding: 16px;
            background: #ffffff;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .stat-item .number {
            font-size: 28px;
            font-weight: 700;
            color: #3b82f6;
        }

        .stat-item .label {
            font-size: 13px;
            color: #64748b;
            margin-top: 4px;
        }

        footer {
            background: #f8fafc;
            padding: 16px 24px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        footer p { color: #64748b; font-size: 14px; }

        @media (max-width: 768px) {
            .profile-card { padding: 20px; }
            .form-row { flex-direction: column; gap: 20px; }
            .stats-grid { grid-template-columns: 1fr; }
            .profile-name { display: none; }
        }
    </style>
</head>
<body>
<div class="admin-layout">
    <!-- Sidebar olib tashlandi, topbar qoldi -->
    <nav class="topbar">
        <div class="topbar-left">
            <span class="logo-icon">📚</span>
            <span class="logo-text">QuizMaster</span>
        </div>
        <div class="topbar-right">
            <div class="user-profile" id="profileBtn">
                <div class="profile-avatar">JD</div>
                <span class="profile-name">John Doe</span>
            </div>
            <div class="dropdown-menu hidden" id="dropdownMenu">
                <a href="/dashboard" class="dropdown-item"><span class="nav-icon">🏠</span> Dashboard</a>
                <a href="/" class="dropdown-item logout">🔚 Chiqish</a>
            </div>
        </div>
    </nav>

    <section class="profile-section">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar-large">JD</div>
                <h1>John Doe</h1>
                <p>Admin • A'zo bo'lgan: 01.01.2025</p>
            </div>

            <form class="profile-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Ism</label>
                        <input type="text" value="John" placeholder="Ismingizni kiriting">
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="john.doe@example.com" placeholder="Email manzilingiz">
                </div>

                <button type="button" id="exit" class="btn-save">🔚 Ortga</button>
            </form>

            <div class="stats-grid">

            </div>
        </div>
    </section>

    <footer>
        <p>© 2025 QuizMaster. Barcha huquqlar himoyalangan.</p>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", async () => {
        const profileAvatar = document.querySelector(".profile-avatar");
        const profileAvatarLarge = document.querySelector(".profile-avatar-large");
        const profileName = document.querySelector(".profile-name");
        const profileHeaderName = document.querySelector(".profile-header h1");
        const profileHeaderInfo = document.querySelector(".profile-header p");
        const inputName = document.querySelector('input[type="text"]');
        const inputEmail = document.querySelector('input[type="email"]');

        // Token localStorage dan olish
        const token = localStorage.getItem("token");

        if (!token) {
            alert("Siz login qilmagansiz!");
            window.location.href = "index.html";
            return;
        }

        try {
            const response = await axios.get("/api/profile", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            const user = response.data; // to‘g‘ridan-to‘g‘ri object

            // Avatar uchun ism bosh harfi
            const initials = user.name.split(' ').map(n => n[0]).join('').toUpperCase();
            profileAvatar.textContent = initials;
            profileAvatarLarge.textContent = initials;

            // Ism va email
            profileName.textContent = user.name;
            profileHeaderName.textContent = user.name;
            profileHeaderInfo.textContent = `Admin • A'zo bo'lgan: ${user.created_at || ''}`;
            inputName.value = user.name;
            inputEmail.value = user.email;


        } catch (error) {
            console.error(error);
            alert("Profil ma'lumotlarini olishda xatolik yuz berdi!");
        }
    });
    const profileBtn = document.getElementById('profileBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');

    profileBtn.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
    document.getElementById('exit').addEventListener('click', () => {
        window.location.href = "/dashboard";
    });
</script>
</body>
</html>
