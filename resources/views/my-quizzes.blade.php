<x-header></x-header>
<div class="app-layout">
    <x-sidebar></x-sidebar>
    <main class="main-content">
        <x-navbar></x-navbar>

        <div class="quizzes-content">
            <div class="filters">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="mine">Created by me</button>
                <button class="filter-btn" data-filter="published">Published</button>
            </div>

            <div class="quizzes-grid" id="quizzesGrid">
                <!-- Quizlar JS orqali shu yerga qo‘shiladi -->
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const quizzesGrid = document.getElementById('quizzesGrid');
    const token = localStorage.getItem('token'); // Sanctum / Passport token

    async function fetchQuizzes() {
        try {
            const response = await axios.get('/api/quizzes', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            const quizzes = response.data.quizzes;
            quizzesGrid.innerHTML = ''; // avvalgi quizlarni tozalash

            quizzes.forEach(quiz => {
                const quizCard = document.createElement('div');
                quizCard.classList.add('quiz-card');
                quizCard.innerHTML = `
                    <div class="quiz-card-header">
                        <h3>${quiz.title}</h3>
                    </div>
                    <p class="quiz-desc">${quiz.description || ''}</p>
                    <div class="quiz-meta">
                        <span>Created: ${new Date(quiz.created_at).toLocaleDateString()}</span>
                        <span class="quiz-status">${quiz.status ?? 'Draft'}</span>
                    </div>
                    <div class="quiz-card-actions">
                        <button class="btn btn-small btn-secondary edit-btn" data-id="${quiz.id}">Edit</button>
                        <button class="btn btn-small btn-secondary delete-btn" data-id="${quiz.id}">Delete</button>
                        <button class="btn btn-small btn-primary take-btn" data-id="${quiz.id}">Take</button>
                    </div>
                `;
                quizzesGrid.appendChild(quizCard);
            });
        } catch (error) {
            console.error(error.response?.data || error);
            quizzesGrid.innerHTML = '<p>Failed to load quizzes.</p>';
        }
    }

    fetchQuizzes();

    // Filter tugmalari
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            const quizCards = document.querySelectorAll('.quiz-card');

            quizCards.forEach(card => {
                const status = card.querySelector('.quiz-status').textContent.toLowerCase();
                if (filter === 'all') {
                    card.style.display = 'block';
                } else if (filter === 'published' && status === 'published') {
                    card.style.display = 'block';
                } else if (filter === 'mine') {
                    // Agar kerak bo‘lsa, 'created_by_me' flag backenddan qo‘shish mumkin
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

</script>
<x-footer></x-footer>
