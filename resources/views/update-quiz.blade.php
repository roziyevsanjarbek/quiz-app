<x-header></x-header>
<div class="app-layout">
    <!-- Sidebar -->
    <x-sidebar></x-sidebar>


    <!-- Main Content -->
    <main class="main-content">
        <x-navbar></x-navbar>


        <div class="create-quiz-content">
            <form class="quiz-form">
                <section class="form-section">
                    <h3>Quiz Details</h3>
                    <div class="form-group">
                        <label for="quiz-title">Quiz Title</label>
                        <input type="text" id="quiz-title" placeholder="Enter quiz title" required>
                    </div>
                    <div class="form-group">
                        <label for="quiz-desc">Description</label>
                        <textarea id="quiz-desc" placeholder="Describe your quiz" rows="4"></textarea>
                    </div>
                </section>

                <section class="form-section">
                    <h3>Add Questions</h3>
                    <div class="questions-list">
                        <div class="question-form">
                            <div class="form-group">
                                <label>Question 1</label>
                                <input type="text" placeholder="Enter your question" class="question-input">
                            </div>
                            <div class="options-group">
                                <div class="form-group">
                                    <label>Option A</label>
                                    <div class="option-input-wrapper">
                                        <input type="text" placeholder="Option A">
                                        <input type="radio" name="answer1" value="a">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Option B</label>
                                    <div class="option-input-wrapper">
                                        <input type="text" placeholder="Option B">
                                        <input type="radio" name="answer1" value="b">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Option C</label>
                                    <div class="option-input-wrapper">
                                        <input type="text" placeholder="Option C">
                                        <input type="radio" name="answer1" value="c">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Option D</label>
                                    <div class="option-input-wrapper">
                                        <input type="text" placeholder="Option D">
                                        <input type="radio" name="answer1" value="d">
                                    </div>
                                </div>
                            </div>
                            <small>Select the correct answer</small>
                        </div>
                    </div>
                    <button id="addQuestionBtn" type="button" class="btn btn-secondary btn-small add-question-btn">+ Add Question</button>
                </section>

                <div class="form-actions">
                    <a href="{{ route('my-quizzes') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Quiz</button>
                </div>
            </form>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

    const questionsList = document.querySelector('.questions-list');
    let questionCount = 1;

    document.querySelector('.add-question-btn').addEventListener('click', function() {
        questionCount++;

        const questionForm = document.createElement('div');
        questionForm.classList.add('question-form');
        questionForm.innerHTML = `
        <div class="form-group">
            <label>Question ${questionCount}</label>
            <input type="text" placeholder="Enter your question" class="question-input">
        </div>
        <div class="options-group">
            ${['A','B','C','D'].map(letter => `
                <div class="form-group">
                    <label>Option ${letter}</label>
                    <div class="option-input-wrapper">
                        <input type="text" placeholder="Option ${letter}">
                        <input type="radio" name="answer${questionCount}" value="${letter.toLowerCase()}">
                    </div>
                </div>
            `).join('')}
        </div>
        <small>Select the correct answer</small>
    `;

        questionsList.appendChild(questionForm);
    });


    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const quizId = urlParams.get('quiz_id');
        const token = localStorage.getItem('token');

        axios.get(`/api/quizzes/${quizId}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        })
            .then(response => {
                const quiz = response.data.quiz;

                // Title va description
                document.getElementById('quiz-title').value = quiz.title;
                document.getElementById('quiz-desc').value = quiz.description || '';

                // Savollarni formga joylash
                const questionsList = document.querySelector('.questions-list');
                questionsList.innerHTML = '';
                let questionCount = 0;

                quiz.questions.forEach(q => {
                    questionCount++;
                    const questionForm = document.createElement('div');
                    questionForm.classList.add('question-form');
                    questionForm.innerHTML = `
                <div class="form-group">
                    <label>Question ${questionCount}</label>
                    <input type="text" placeholder="Enter your question" class="question-input" value="${q.question_text}">
                </div>
                <div class="options-group">
                    ${q.options.map((opt, index) => {
                        const letter = String.fromCharCode(65 + index);
                        return `
                            <div class="form-group">
                                <label>Option ${letter}</label>
                                <div class="option-input-wrapper">
                                    <input type="text" placeholder="Option ${letter}" value="${opt.option_text}">
                                    <input type="radio" name="answer${questionCount}" value="${letter.toLowerCase()}" ${opt.is_correct ? 'checked' : ''}>
                                </div>
                            </div>
                        `;
                    }).join('')}
                </div>
                <small>Select the correct answer</small>
            `;
                    questionsList.appendChild(questionForm);
                });
            })
            .catch(err => {
                console.error(err.response?.data || err);
                alert('Failed to load quiz data.');
            });
    });

    document.querySelector('.quiz-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Default form submitni to'xtatamiz

        const urlParams = new URLSearchParams(window.location.search);
        const quizId = urlParams.get('quiz_id');
        const token = localStorage.getItem('token');

        // Title va description
        const title = document.getElementById('quiz-title').value;
        const description = document.getElementById('quiz-desc').value;

        // Savollar va ularning variantlarini yig‘ish
        const questions = [];
        const questionForms = document.querySelectorAll('.question-form');

        questionForms.forEach((qForm, qIndex) => {
            const questionText = qForm.querySelector('.question-input').value;
            const optionsInputs = qForm.querySelectorAll('.options-group .option-input-wrapper');

            const options = [];
            optionsInputs.forEach(optDiv => {
                const text = optDiv.querySelector('input[type="text"]').value;
                const isCorrect = optDiv.querySelector('input[type="radio"]').checked ? 1 : 0;
                options.push({ option_text: text, is_correct: isCorrect });
            });

            questions.push({
                question_text: questionText,
                type: 'multiple_choice',
                options: options
            });
        });

        // Axios POST request
        axios.post(`/api/quizzes/${quizId}`, {
            title,
            description,
            questions
        }, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        })
            .then(response => {
                alert('Quiz updated successfully!');
                window.location.href = '/my-quizzes';
            })
            .catch(err => {
                console.error(err.response?.data || err);
                alert('Failed to update quiz.');
            });
    });


</script>
<x-footer></x-footer>
