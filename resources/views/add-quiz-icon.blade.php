<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Boshqaruvi - Admin Panel</title>
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
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }


        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 24px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .menu-item.active {
            background: #3b82f6;
            color: white;
        }

        .menu-icon { font-size: 20px; }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }




        /* Content Section */
        .content-section {
            flex: 1;
            padding: 24px;
            overflow-y: auto;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        /* Quiz Grid */
        .quiz-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .quiz-card {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .quiz-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }

        .quiz-card.selected {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .quiz-card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 12px;
        }

        .quiz-icon {
            font-size: 36px;
            display: block;
        }

        .quiz-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: #e0e7ff;
            color: #4338ca;
        }

        .quiz-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .quiz-description {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .quiz-meta {
            display: flex;
            gap: 16px;
            font-size: 13px;
            color: #64748b;
        }

        /* Icon Selector Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-overlay:not(.hidden) {
            display: flex;
        }

        .modal {
            background: white;
            border-radius: 16px;
            padding: 32px;
            max-width: 500px;
            width: 90%;
        }

        .modal-header {
            margin-bottom: 24px;
        }

        .modal-title {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .modal-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        .upload-section {
            margin-bottom: 24px;
            padding: 20px;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .upload-section:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .upload-section.dragover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .upload-icon {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .upload-text {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .upload-hint {
            color: #64748b;
            font-size: 13px;
        }

        #fileInput {
            display: none;
        }

        .uploaded-icon-preview {
            margin-top: 16px;
            display: none;
        }

        .uploaded-icon-preview.active {
            display: block;
        }

        .preview-icon {
            font-size: 64px;
            margin-bottom: 8px;
        }

        .preview-text {
            color: #10b981;
            font-weight: 600;
        }

        .icon-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }

        .icon-option {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .icon-option:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .icon-option.selected {
            border-color: #3b82f6;
            background: #3b82f6;
            transform: scale(1.1);
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }

        .btn-cancel {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-cancel:hover { background: #e2e8f0; }

        .btn-save {
            background: #3b82f6;
            color: white;
        }

        .btn-save:hover { background: #2563eb; }

        footer {
            background: #f8fafc;
            padding: 16px 24px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        footer p { color: #64748b; font-size: 14px; }

    </style>
</head>
<body>
<div class="admin-layout">
    <!-- Sidebar -->
   <x-sidebar></x-sidebar>
    <!-- Main Content -->
    <div class="main-content">
        <x-navbar></x-navbar>

        <section class="content-section">
            <div class="page-header">
                <h1 class="page-title">Quiz ikonkalarini tahrirlash</h1>
                <p class="page-subtitle">Har bir quiz uchun mos ikonkani tanlang</p>
            </div>

            <div class="quiz-grid" id="quiz-grid">
                <div class="quiz-card" data-quiz-id="1">
                    <div class="quiz-card-header">
                        <span class="quiz-icon">💻</span>
                        <span class="quiz-badge">Dasturlash</span>
                    </div>
                    <h3 class="quiz-title">JavaScript asoslari</h3>
                    <p class="quiz-description">JavaScript dasturlash tilining asosiy tushunchalari</p>
                    <div class="quiz-meta">
                        <span>⏱ 15 daqiqa</span>
                        <span>❓ 10 savol</span>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <p>© 2025 QuizMaster. Barcha huquqlar himoyalangan.</p>
        </footer>
    </div>
</div>

<!-- Icon Selector Modal -->
<div class="modal-overlay hidden" id="iconModal">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">Icon tanlang</h2>
            <p class="modal-subtitle">Quiz uchun mos ikonkani tanlang</p>
        </div>

        <div class="upload-section" id="uploadSection">
            <div class="upload-icon">📤</div>
            <div class="upload-text">Icon yuklash uchun bosing yoki bu yerga tashlang</div>
            <div class="upload-hint">PNG, JPG, SVG yoki Emoji (max 2MB)</div>
            <input type="file" id="fileInput" accept="image/*,.svg">
        </div>

        <div class="uploaded-icon-preview" id="iconPreview">
            <div class="preview-icon" id="previewIcon"></div>
            <div class="preview-text">Icon yuklandi</div>
        </div>


        <div class="modal-actions">
            <button class="btn btn-cancel" id="cancelBtn">Bekor qilish</button>
            <button class="btn btn-save" id="saveBtn">Saqlash</button>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const profileBtn = document.getElementById('profileBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const iconModal = document.getElementById('iconModal');
    const quizGrid = document.getElementById('quiz-grid');
    const iconGrid = document.getElementById('iconGrid');
    const iconOptions = document.querySelectorAll('.icon-option');
    const cancelBtn = document.getElementById('cancelBtn');
    const saveBtn = document.getElementById('saveBtn');
    const uploadSection = document.getElementById('uploadSection');
    const fileInput = document.getElementById('fileInput');
    const iconPreview = document.getElementById('iconPreview');
    const previewIcon = document.getElementById('previewIcon');
    const token = localStorage.getItem('token');

    let selectedQuizCard = null;
    let selectedIcon = null;
    let uploadedIconData = null;

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
                 <div class="quiz-card" data-quiz-id="${q.id}">
                    <div class="quiz-card-header">
                        <span class="quiz-icon"> ${`<img src="${q.icon_url}" width="36" alt="Quiz Icon">`}</span>
                        <span class="quiz-badge">${q.title}</span>
                    </div>
                    <h3 class="quiz-title">${q.title}</h3>
                    <p class="quiz-description">${q.description}</p>
                    <div class="quiz-meta">
                        <span>❓ ${q.questions_count} savol</span>
                    </div>
                 </div>
            `;
                quizGrid.innerHTML += card;
            });

        } catch (error) {
            console.error("Xatolik:", error);
        }
    }

    saveBtn.addEventListener('click', async () => {
        if (!selectedQuizCard || !uploadedIconData) {
            alert('Icon tanlang');
            return;
        }

        const quizId = selectedQuizCard.dataset.quizId;

        const file = fileInput.files[0];
        const formData = new FormData();
        formData.append('icon', file);

        try {
            const res = await axios.post(
                `/api/quizzes/${quizId}/icon`,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    }
                }
            );

            // UI update
            const iconEl = selectedQuizCard.querySelector('.quiz-icon');
            iconEl.innerHTML = `<img src="${res.data.path}" width="36">`;

            iconModal.classList.add('hidden');
            fileInput.value = '';

        } catch (e) {
            console.error(e);
            alert('Icon saqlanmadi');
        }
    });



    quizGrid.addEventListener('click', (e) => {
        const card = e.target.closest('.quiz-card');
        if (!card) return;

        selectedQuizCard = card;

        const iconEl = card.querySelector('.quiz-icon');
        selectedIcon = iconEl.textContent;
        uploadedIconData = null;

        // Reset preview
        iconPreview.classList.remove('active');
        previewIcon.textContent = '';
        previewIcon.style.backgroundImage = '';

        // Agar emoji iconlar bo‘lsa (ixtiyoriy)
        iconOptions.forEach(opt => opt.classList.remove('selected'));

        iconModal.classList.remove('hidden');
    });


    uploadSection.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            handleFileUpload(file);
        }
    });

    // Drag and drop
    uploadSection.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadSection.classList.add('dragover');
    });

    uploadSection.addEventListener('dragleave', () => {
        uploadSection.classList.remove('dragover');
    });

    uploadSection.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadSection.classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        if (file) {
            handleFileUpload(file);
        }
    });

    function handleFileUpload(file) {
        // Check file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Fayl hajmi 2MB dan kichik bo\'lishi kerak');
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            uploadedIconData = e.target.result;

            // Show preview
            if (file.type.startsWith('image/')) {
                previewIcon.style.backgroundImage = `url(${uploadedIconData})`;
                previewIcon.style.backgroundSize = 'cover';
                previewIcon.style.width = '64px';
                previewIcon.style.height = '64px';
                previewIcon.style.borderRadius = '8px';
                previewIcon.style.margin = '0 auto';
                previewIcon.textContent = '';
            } else {
                previewIcon.textContent = '📄';
            }

            iconPreview.classList.add('active');
            selectedIcon = uploadedIconData;

            // Deselect emoji icons
            iconOptions.forEach(opt => opt.classList.remove('selected'));
        };
        reader.readAsDataURL(file);
    }

    // Icon selection
    iconOptions.forEach(option => {
        option.addEventListener('click', () => {
            iconOptions.forEach(opt => opt.classList.remove('selected'));
            option.classList.add('selected');
            selectedIcon = option.dataset.icon;
            uploadedIconData = null;

            // Hide upload preview
            iconPreview.classList.remove('active');
        });
    });

    // Cancel button
    cancelBtn.addEventListener('click', () => {
        iconModal.classList.add('hidden');
        selectedQuizCard = null;
        selectedIcon = null;
        uploadedIconData = null;
        iconPreview.classList.remove('active');
    });

    saveBtn.addEventListener('click', () => {
        if (selectedQuizCard && selectedIcon) {
            const iconElement = selectedQuizCard.querySelector('.quiz-icon');

            if (uploadedIconData) {
                // Set uploaded image as background
                iconElement.style.backgroundImage = `url(${uploadedIconData})`;
                iconElement.style.backgroundSize = 'cover';
                iconElement.style.width = '36px';
                iconElement.style.height = '36px';
                iconElement.style.borderRadius = '6px';
                iconElement.textContent = '';
            } else {
                // Set emoji
                iconElement.style.backgroundImage = '';
                iconElement.style.width = '';
                iconElement.style.height = '';
                iconElement.textContent = selectedIcon;
            }

            iconModal.classList.add('hidden');
            selectedQuizCard = null;
            selectedIcon = null;
            uploadedIconData = null;
            iconPreview.classList.remove('active');
        }
    });

    // Close modal on overlay click
    iconModal.addEventListener('click', (e) => {
        if (e.target === iconModal) {
            iconModal.classList.add('hidden');
            selectedQuizCard = null;
            selectedIcon = null;
            uploadedIconData = null;
            iconPreview.classList.remove('active');
        }
    });
</script>
</body>
</html>
