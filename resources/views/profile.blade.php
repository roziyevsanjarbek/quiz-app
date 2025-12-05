<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasur Abdullayev - Frontend Developer</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="profile-header">
            <img src="/placeholder.svg?height=120&width=120" alt="Profile photo" class="avatar">
            <h1 class="name">Jasur Abdullayev</h1>
            <p class="title">Frontend Developer</p>
            <p class="tagline">Zamonaviy va foydalanuvchilarga qulay web ilovalar yarataman</p>
        </div>

        <nav class="nav-links">
            <a href="#about" class="nav-link active">
                <span class="nav-indicator"></span>
                Men haqimda
            </a>
            <a href="#experience" class="nav-link">
                <span class="nav-indicator"></span>
                Tajriba
            </a>
            <a href="#projects" class="nav-link">
                <span class="nav-indicator"></span>
                Loyihalar
            </a>
        </nav>

        <div class="social-links">
            <a href="#" class="social-link" aria-label="GitHub">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>
            </a>
            <a href="#" class="social-link" aria-label="LinkedIn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
            </a>
            <a href="#" class="social-link" aria-label="Twitter">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
            </a>
            <a href="#" class="social-link" aria-label="Telegram">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- About Section -->
        <section id="about" class="section">
            <p class="intro-text">
                Men <strong>chiroyli va qulay</strong> foydalanuvchi interfeyslarini yaratishga ishtiyoqli dasturchiman.
                Mening ishim dizayn va dasturlash kesishmasida joylashgan — nafaqat yaxshi ko'rinadigan, balki
                <strong>tez va samarali</strong> ishlaydigan ilovalar yarataman.
            </p>
            <p class="intro-text">
                Hozirda <strong class="highlight">TechCorp</strong> kompaniyasida Senior Frontend Developer lavozimida ishlayman.
                Bu yerda men UI komponentlarini yaratish va texnik qo'llab-quvvatlash bilan shug'ullanaman.
            </p>
            <p class="intro-text">
                Bo'sh vaqtlarimda yangi texnologiyalarni o'rganaman, open-source loyihalarga hissa qo'shaman
                va yoshlarga dasturlash bo'yicha mentorlik qilaman.
            </p>
        </section>

        <!-- Experience Section -->
        <section id="experience" class="section">
            <h2 class="section-title">Tajriba</h2>

            <div class="experience-item">
                <div class="experience-date">2022 — Hozir</div>
                <div class="experience-content">
                    <h3 class="experience-title">
                        Senior Frontend Developer · <a href="#" class="company-link">TechCorp</a>
                    </h3>
                    <p class="experience-description">
                        Kompaniyaning asosiy mahsulotlari uchun frontend arxitekturasini loyihalash va ishlab chiqish.
                        Cross-functional jamoalar bilan ishlash va yangi texnologiyalarni joriy etish.
                    </p>
                    <div class="skills-list">
                        <span class="skill-tag">React</span>
                        <span class="skill-tag">TypeScript</span>
                        <span class="skill-tag">Next.js</span>
                        <span class="skill-tag">Tailwind CSS</span>
                    </div>
                </div>
            </div>

            <div class="experience-item">
                <div class="experience-date">2020 — 2022</div>
                <div class="experience-content">
                    <h3 class="experience-title">
                        Frontend Developer · <a href="#" class="company-link">StartupHub</a>
                    </h3>
                    <p class="experience-description">
                        E-commerce platformasi uchun foydalanuvchi interfeysini yaratish.
                        Performance optimizatsiyasi va mobile-responsive dizayn ishlab chiqish.
                    </p>
                    <div class="skills-list">
                        <span class="skill-tag">Vue.js</span>
                        <span class="skill-tag">JavaScript</span>
                        <span class="skill-tag">SCSS</span>
                        <span class="skill-tag">Figma</span>
                    </div>
                </div>
            </div>

            <div class="experience-item">
                <div class="experience-date">2018 — 2020</div>
                <div class="experience-content">
                    <h3 class="experience-title">
                        Junior Developer · <a href="#" class="company-link">WebAgency</a>
                    </h3>
                    <p class="experience-description">
                        Turli mijozlar uchun web saytlar va landing pagelar yaratish.
                        HTML, CSS va JavaScript asoslarini chuqur o'rganish.
                    </p>
                    <div class="skills-list">
                        <span class="skill-tag">HTML</span>
                        <span class="skill-tag">CSS</span>
                        <span class="skill-tag">JavaScript</span>
                        <span class="skill-tag">WordPress</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section id="projects" class="section">
            <h2 class="section-title">Loyihalar</h2>

            <div class="projects-grid">
                <article class="project-card">
                    <div class="project-image">
                        <img src="/placeholder.svg?height=200&width=350" alt="Dashboard loyihasi">
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">Admin Dashboard</h3>
                        <p class="project-description">
                            Zamonaviy admin panel loyihasi. Real-time ma'lumotlar va interaktiv grafiklar.
                        </p>
                        <div class="skills-list">
                            <span class="skill-tag">React</span>
                            <span class="skill-tag">Chart.js</span>
                        </div>
                    </div>
                </article>

                <article class="project-card">
                    <div class="project-image">
                        <img src="/placeholder.svg?height=200&width=350" alt="E-commerce loyihasi">
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">E-commerce Platform</h3>
                        <p class="project-description">
                            To'liq funksional onlayn do'kon. Savat, to'lov va buyurtma kuzatish tizimlari.
                        </p>
                        <div class="skills-list">
                            <span class="skill-tag">Next.js</span>
                            <span class="skill-tag">Stripe</span>
                        </div>
                    </div>
                </article>

                <article class="project-card">
                    <div class="project-image">
                        <img src="/placeholder.svg?height=200&width=350" alt="Task Manager loyihasi">
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">Task Manager</h3>
                        <p class="project-description">
                            Kanban uslubidagi vazifalarni boshqarish ilovasi. Drag-and-drop funksiyasi.
                        </p>
                        <div class="skills-list">
                            <span class="skill-tag">Vue.js</span>
                            <span class="skill-tag">Firebase</span>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="section contact-section">
            <h2 class="section-title">Bog'lanish</h2>
            <p class="contact-text">
                Yangi loyihalar yoki hamkorlik uchun men bilan bog'laning:
            </p>
            <a href="mailto:jasur@example.com" class="contact-email">jasur@example.com</a>
        </section>
    </main>
</div>
</body>
</html>
