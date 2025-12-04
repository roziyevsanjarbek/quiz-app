<x-header></x-header>

<div class="app-layout">
    <!-- Sidebar -->
    <x-sidebar></x-sidebar>

    <!-- Main Content -->
    <main class="main-content">
        <nav class="topbar">
            <div class="topbar-left">
                <h2>Fayl Yuklash</h2>
            </div>
            <div class="topbar-right">
                <div class="user-profile">
                    <img src="/placeholder.svg?height=40&width=40" alt="Profile" class="profile-avatar">
                    <span class="profile-name">Foydalanuvchi</span>
                </div>
            </div>
        </nav>

        <div class="quizzes-content">
            <!-- Upload Area -->
            <section class="upload-section">
                <div class="upload-container">
                    <div class="upload-area" id="uploadArea">
                        <div class="upload-icon">📤</div>
                        <h2>Faylni Shu Yerga Qo'ying</h2>
                        <p>yoki</p>
                        <button class="btn btn-primary" onclick="document.getElementById('fileInput').click()">
                            Faylni Tanlash
                        </button>
                        <input type="file" id="fileInput" multiple style="display: none;" accept=".pdf,.doc,.docx,.txt,.jpg,.png">
                        <p class="upload-hint">PDF, DOC, DOCX, TXT, JPG, PNG qabul qilinadi</p>
                    </div>
                </div>
            </section>

            <!-- Files List Section -->
            <section class="files-section">
                <div class="section-header">
                    <h3>Yuklangan Fayllar</h3>
                    <span class="file-count" id="fileCount">0 ta fayl</span>
                </div>
                <div class="files-list" id="filesList">
                    <div class="empty-state">
                        <span class="empty-icon">📂</span>
                        <p>Hozircha fayl yoq</p>
                    </div>
                </div>
            </section>

            <!-- Create Quiz Section -->
            <section class="create-quiz-section">
                <div class="quiz-creation-card">
                    <div class="quiz-creation-content">
                        <h3>Testni Yaratish</h3>
                        <p>Tanlangan fayllardan avtomatik ravishda test savollarini yarating</p>
                    </div>
                    <button class="btn btn-primary btn-large" id="createQuizBtn" onclick="createQuizFromFile()" disabled>
                        Test Yaratish
                    </button>
                </div>
            </section>
        </div>
    </main>
</div>

<script>
    let uploadedFiles = [];
    let selectedFiles = [];

    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const filesList = document.getElementById('filesList');
    const fileCount = document.getElementById('fileCount');
    const createQuizBtn = document.getElementById('createQuizBtn');

    // Drag and drop events
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        handleFiles(e.dataTransfer.files);
    });

    // File input change
    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    // Handle files
    function handleFiles(files) {
        for (let file of files) {
            if (uploadedFiles.some(f => f.name === file.name)) continue;

            uploadedFiles.push({
                name: file.name,
                size: formatFileSize(file.size),
                type: getFileType(file.name),
                date: new Date().toLocaleDateString('uz-UZ'),
                id: Math.random().toString(36).substr(2, 9)
            });
        }
        renderFiles();
    }

    // Render files list
    function renderFiles() {
        if (uploadedFiles.length === 0) {
            filesList.innerHTML = `
                    <div class="empty-state">
                        <span class="empty-icon">📂</span>
                        <p>Hozircha fayl yoq</p>
                    </div>
                `;
            fileCount.textContent = '0 ta fayl';
            return;
        }

        fileCount.textContent = uploadedFiles.length + ' ta fayl';
        filesList.innerHTML = uploadedFiles.map(file => `
                <div class="file-item" data-id="${file.id}">
                    <div class="file-info">
                        <span class="file-icon">${file.type}</span>
                        <div class="file-details">
                            <h4>${file.name}</h4>
                            <p>${file.size} • ${file.date}</p>
                        </div>
                    </div>
                    <div class="file-actions">
                        <input type="checkbox" class="file-checkbox" onchange="toggleFileSelection('${file.id}')">
                        <button class="btn btn-small btn-secondary" onclick="deleteFile('${file.id}')">🗑️ O'chirish</button>
                    </div>
                </div>
            `).join('');
    }

    // Select/deselect file
    function toggleFileSelection(fileId) {
        const index = selectedFiles.indexOf(fileId);
        if (index > -1) {
            selectedFiles.splice(index, 1);
        } else {
            selectedFiles.push(fileId);
        }
        updateCreateButton();
    }

    // Delete file
    function deleteFile(fileId) {
        uploadedFiles = uploadedFiles.filter(f => f.id !== fileId);
        selectedFiles = selectedFiles.filter(id => id !== fileId);
        renderFiles();
        updateCreateButton();
    }

    // Update create button state
    function updateCreateButton() {
        createQuizBtn.disabled = selectedFiles.length === 0;
    }

    // Create quiz
    function createQuizFromFile() {
        if (selectedFiles.length === 0) {
            alert('Iltimos, test yaratish uchun fayl tanlang');
            return;
        }
        const selectedFileNames = uploadedFiles
            .filter(f => selectedFiles.includes(f.id))
            .map(f => f.name)
            .join(', ');
        alert(`✅ Test "${selectedFileNames}" fayllardan yaratilmoqda...`);
    }

    // Format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    // Get file type emoji
    function getFileType(filename) {
        const ext = filename.split('.').pop().toLowerCase();
        const types = {
            pdf: '📄', doc: '📝', docx: '📝', txt: '📄',
            jpg: '🖼️', png: '🖼️', jpeg: '🖼️'
        };
        return types[ext] || '📎';
    }

    // Initialize
    updateCreateButton();

    // Logout
    document.querySelector('.logout-btn').addEventListener('click', function() {
        window.location.href = 'index.html';
    });
</script>
</body>
</html>
