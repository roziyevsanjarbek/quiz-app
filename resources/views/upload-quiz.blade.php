<x-header></x-header>

<div class="app-layout">
    <!-- Sidebar -->
    <x-sidebar></x-sidebar>

    <!-- Main Content -->
    <main class="main-content">
        <x-navbar></x-navbar>

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

                        <input type="file" id="fileInput" multiple style="display: none;"
                               accept=".pdf,.doc,.docx,.txt,.jpg,.png">

                        <p class="upload-hint">PDF, DOC, DOCX, TXT, JPG, PNG qabul qilinadi</p>

                        <!-- 🔥 COUNT INPUT QO‘SHILDI -->
                        <div class="count-box" style="margin-top: 20px;">
                            <label for="fileCount" style="font-weight: 600;">Nechta element yuklanadi:</label>
                            <input type="number" id="fileCount" min="1" class="form-control"
                                   placeholder="Masalan: 5" style="margin-top: 8px; padding: 10px;">
                        </div>

{{--                        <!-- 🔥 YUKLASHNI BOSHLASH TUGMASI -->--}}
{{--                        <button class="btn btn-success" style="margin-top: 15px;" onclick="startUpload()">--}}
{{--                            Yuklashni Boshlash--}}
{{--                        </button>--}}

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


        document.getElementById('fileInput').addEventListener('change', function (e) {
        const files = e.target.files;
        const token = localStorage.getItem('token');
        if (files.length === 0) {
        alert("Fayl tanlanmadi!");
        return;
    }

        let formData = new FormData();

        // 1 ta fayl topshiryapsiz deb o'ylaymiz
        formData.append('file', files[0]);
        formData.append('questions_count' , fileCount.value)

        axios.post('/api/quiz/upload', formData, {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
    }
    })
        .then(response => {
        console.log(response.data);
        alert("Fayl muvaffaqiyatli yuklandi!");

        window.location.href = '/my-quizzes'
    })
        .catch(error => {
        console.error(error.response?.data || error);
        alert("Fayl yuklashda xatolik!");
    });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const filesList = document.getElementById("filesList");
        const fileCount = document.getElementById("fileCount");
        // LocalStorage dan token olish
        const token = localStorage.getItem('token');

        axios.get('/api/quiz/upload', {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        })
        .then(response => {
            const files = response.data.files;

            // Fayl sonini yangilash
            fileCount.textContent = `${files.length} ta fayl`;

            // Bo'sh stateni olib tashlash
            filesList.innerHTML = '';

            if (files.length === 0) {
                filesList.innerHTML = `
                <div class="empty-state">
                    <span class="empty-icon">📂</span>
                <p>Hozircha fayl yo'q</p>
            </div>
                `;
            } else {
                files.forEach(file => {
                    const fileItem = document.createElement("div");
                    fileItem.classList.add("file-item");
                    fileItem.innerHTML = `
                <a href="${file.url}" target="_blank">${file.name}</a>
                `;
                    filesList.appendChild(fileItem);
                });
            }
        })
        .catch(error => {
            console.error('Fayllarni olishda xatolik:', error);
        });
            });

</script>
<x-footer></x-footer>
