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
                    <button type="submit" class="btn btn-primary">Create Quiz</button>
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


        document.querySelector('.quiz-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const token = localStorage.getItem('token');
            const title = document.getElementById('quiz-title').value;
            const description = document.getElementById('quiz-desc').value;

            const questionForms = document.querySelectorAll('.question-form');
            const questions = [];

            for (const qForm of questionForms) {
                const questionText = qForm.querySelector('.question-input').value.trim();
                if (!questionText) continue;

                const optionsInputs = qForm.querySelectorAll('.options-group .option-input-wrapper');
                const options = [];
                let hasCorrect = false;

                for (const opt of optionsInputs) {
                    const optionText = opt.querySelector('input[type="text"]').value.trim();
                    const isCorrect = opt.querySelector('input[type="radio"]').checked;

                    if (!optionText) continue;

                    if (isCorrect) hasCorrect = true;

                    options.push({ option_text: optionText, is_correct: isCorrect });
                }

                // Agar hech qanday radio belgilamagan bo‘lsa, alert
                if (!hasCorrect) {
                    alert('Please select the correct answer for each question.');
                    return;
                }

                questions.push({
                    question_text: questionText,
                    type: 'multiple_choice',
                    options
                });
            }

            if (questions.length === 0) {
                alert('Please add at least one question with options.');
                return;
            }

            try {
                const response = await axios.post('/api/quizzes', {
                    title,
                    description,
                    questions
                }, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                alert('Quiz created successfully!');
                window.location.href = '/my-quizzes';
            } catch (error) {
                console.error(error.response.data);
                alert('Validation failed! Check console for details.');
            }
        });

</script>
<x-footer></x-footer>
