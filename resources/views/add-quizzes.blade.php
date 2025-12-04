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
                    <div class="form-row">
                        <div class="form-group">
                            <label for="quiz-category">Category</label>
                            <select id="quiz-category">
                                <option>Technology</option>
                                <option>Science</option>
                                <option>History</option>
                                <option>Languages</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quiz-difficulty">Difficulty</label>
                            <select id="quiz-difficulty">
                                <option>Easy</option>
                                <option>Medium</option>
                                <option>Hard</option>
                            </select>
                        </div>
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
                    <button type="button" class="btn btn-secondary btn-small add-question-btn">+ Add Question</button>
                </section>

                <div class="form-actions">
                    <a href="{{ route('my-quizzes') }}" class="btn btn-secondary">Cancel</a>
                    <button type="button" class="btn btn-secondary save-draft-btn">Save as Draft</button>
                    <button type="submit" class="btn btn-primary">Publish Quiz</button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
    document.querySelector('.logout-btn').addEventListener('click', function() {
        window.location.href = 'index.html';
    });

    document.querySelector('.quiz-form').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Quiz published successfully!');
        window.location.href = 'my-quizzes.html';
    });

    document.querySelector('.add-question-btn').addEventListener('click', function() {
        alert('Question added! (Add more question forms as needed)');
    });
</script>
</body>
</html>
