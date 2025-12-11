<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizMaster - Admin Panel</title>
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

        /* Sidebar stillari qo'shildi */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #1e293b;
            color: white;
            padding: 24px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-logo {
            font-size: 22px;
            font-weight: 700;
            color: #3b82f6;
            text-decoration: none;
            padding: 0 20px;
            display: block;
            margin-bottom: 32px;
        }

        .sidebar-logo span {
            font-size: 11px;
            background: #3b82f6;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            margin-left: 6px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background: #334155;
            color: white;
            border-left-color: #3b82f6;
        }

        .sidebar-menu li a svg {
            width: 20px;
            height: 20px;
        }

        .sidebar-section {
            padding: 16px 20px 8px;
            font-size: 11px;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 1px;
        }

        /* Main content uchun layout */
        .main-content {
            flex: 1;
            margin-left: 250px;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        header {
            background: #f8fafc;
            padding: 16px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-user .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #3b82f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
        }

        /* Admin Section */
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

        /* Search */
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

        /* Table */
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

        /* Footer */
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

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; }
            .stats-row { flex-direction: column; }
            .table-container { overflow-x: auto; }
            table { min-width: 600px; }
        }
    </style>
</head>
<body>
<div class="admin-layout">
    <!-- Sidebar qo'shildi -->
    <aside class="sidebar">
        <a href="index.html" class="sidebar-logo">QuizMaster <span>Admin</span></a>

        <div class="sidebar-section">Asosiy</div>
        <ul class="sidebar-menu">
            <li>
                <a href="admin.html" class="active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                    Foydalanuvchilar
                </a>
            </li>
            <li>
                <a href="#">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Natijalar
                </a>
            </li>
        </ul>

        <div class="sidebar-section">Quizlar</div>
        <ul class="sidebar-menu">
            <li>
                <a href="#">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Barcha quizlar
                </a>
            </li>
            <li>
                <a href="#">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Quiz qo'shish
                </a>
            </li>
            <li>
                <a href="#">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Kategoriyalar
                </a>
            </li>
        </ul>

        <div class="sidebar-section">Sozlamalar</div>
        <ul class="sidebar-menu">
            <li>
                <a href="#">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Sozlamalar
                </a>
            </li>
            <li>
                <a href="index.html">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Chiqish
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header>
            <div class="header-title">Dashboard</div>
            <div class="header-user">
                <span>Admin</span>
                <div class="avatar">AD</div>
            </div>
        </header>

        <!-- Admin Section -->
        <section class="admin-section">
            <!-- Stats -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="number">156</div>
                    <div class="label">Jami foydalanuvchilar</div>
                </div>
                <div class="stat-card">
                    <div class="number">342</div>
                    <div class="label">Yechilgan quizlar</div>
                </div>
                <div class="stat-card">
                    <div class="number">78%</div>
                    <div class="label">O'rtacha natija</div>
                </div>
            </div>

            <!-- Search -->
            <div class="search-box">
                <input type="text" placeholder="Ism yoki familya bo'yicha qidirish...">
            </div>

            <!-- Table -->
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
                    <tbody>
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="avatar">AK</div>
                                <span class="user-name">Alisher Karimov</span>
                            </div>
                        </td>
                        <td class="quiz-name">JavaScript asoslari</td>
                        <td><span class="score-badge score-high">85%</span></td>
                        <td class="date">10.12.2025</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="avatar">NS</div>
                                <span class="user-name">Nodira Saidova</span>
                            </div>
                        </td>
                        <td class="quiz-name">Python dasturlash</td>
                        <td><span class="score-badge score-high">92%</span></td>
                        <td class="date">10.12.2025</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="avatar">JR</div>
                                <span class="user-name">Jamshid Rahimov</span>
                            </div>
                        </td>
                        <td class="quiz-name">HTML va CSS</td>
                        <td><span class="score-badge score-medium">65%</span></td>
                        <td class="date">09.12.2025</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="avatar">MA</div>
                                <span class="user-name">Malika Azimova</span>
                            </div>
                        </td>
                        <td class="quiz-name">React framework</td>
                        <td><span class="score-badge score-high">88%</span></td>
                        <td class="date">09.12.2025</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="avatar">BT</div>
                                <span class="user-name">Bobur Toshmatov</span>
                            </div>
                        </td>
                        <td class="quiz-name">JavaScript asoslari</td>
                        <td><span class="score-badge score-low">45%</span></td>
                        <td class="date">08.12.2025</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="avatar">GI</div>
                                <span class="user-name">Gulnora Ismoilova</span>
                            </div>
                        </td>
                        <td class="quiz-name">Umumiy bilim</td>
                        <td><span class="score-badge score-medium">72%</span></td>
                        <td class="date">08.12.2025</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="avatar">SK</div>
                                <span class="user-name">Sardor Kasimov</span>
                            </div>
                        </td>
                        <td class="quiz-name">Matematika</td>
                        <td><span class="score-badge score-high">95%</span></td>
                        <td class="date">07.12.2025</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Footer -->
        <footer>
            <p>© 2025 QuizMaster. Barcha huquqlar himoyalangan.</p>
        </footer>
    </div>
</div>
</body>
</html>
