<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz - QuizMaster</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .no-sidebar .main-content {
            margin-left: 0;
            width: 100%;
        }

        .full-width {
            width: 100%;
        }

        .option.correct {
            background: #c8f7c5; /* Yashil */
        }

        .option.incorrect {
            background: #f7c5c5; /* Qizil */
        }

    </style>
</head>
<body>

<div class="app-layout no-sidebar">
    <!-- Main Content -->
    <main class="main-content full-width">
        <nav class="topbar">
            <div class="topbar-left">
                <h2>JavaScript Fundamentals</h2>
            </div>
            <div class="topbar-right">
            </div>
        </nav>

        <div class="quiz-content">

            <div class="quiz-progress">
                <div class="progress-info">
                    <span class="progress-text">Question 1 of 10</span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 0%;"></div>
                    </div>
                </div>
            </div>


            <div class="question-container">
                <div class="question-header">
                    <h3>What is the output of this JavaScript code?</h3>
                    <code class="code-block">console.log(typeof undefined)</code>
                </div>

                <div class="options-container">
                    <label class="option">
                        <input type="radio" name="question3" value="a">
                        <span class="option-label">"undefined"</span>
                    </label>
                    <label class="option">
                        <input type="radio" name="question3" value="b">
                        <span class="option-label">undefined</span>
                    </label>
                    <label class="option">
                        <input type="radio" name="question3" value="c">
                        <span class="option-label">"object"</span>
                    </label>
                    <label class="option">
                        <input type="radio" name="question3" value="d">
                        <span class="option-label">null</span>
                    </label>
                </div>
            </div>

            <div class="quiz-navigation">

                <div class="question-indicators">
                </div>



                <button class="btn btn-primary">Next →</button>
            </div>

            <div class="quiz-actions">
                <button class="btn btn-secondary">Exit Quiz</button>
            </div>

        </div>
    </main>
</div>

<script>
    const params = new URLSearchParams(window.location.search);
    const attemptId = params.get("attempt_id");
    const urlParts = window.location.pathname.split('/');
    const quizId = urlParts[2]; // 0 = '', 1 = 'quiz', 2 = '4', 3 = 'start'
    let questionId;
    console.log(quizId)
    let count = 0

    let selectedOptionId = null;


    const questionTitle = document.querySelector('.question-header h3');
    const codeBlock = document.querySelector('.code-block');
    const optionsContainer = document.querySelector('.options-container');
    const nextBtn = document.querySelector('.quiz-navigation .btn.btn-primary');

    nextBtn.disabled = true; // avvaliga bosilmaydi

    // ⬇️ 3) JAVOBNI BACKENDGA YUBORISH
    async function getQuestionId() {
        const response = await fetch(`/api/get-question-id/${quizId}`);
        const data = await response.json();

        console.log("Question ID API javobi:", data);

        questionId = data.question_id; // <-- to'g'ridan-to'g'ri olamiz
        return questionId;
    }


    // const res =

    console.log(questionId)



    // ⬇️ 1) SAVOLNI API DAN YUKLASH
    async function loadQuestion() {
        if(count === 0 )await getQuestionId()
        try {
            const res = await fetch(`/api/quiz/${quizId}/${questionId}`);
            const data = await res.json();
            console.log(data.question);

            renderQuestion(data.question);

            // ➤ progressni yangilash
            const totalQuestions = data.total_questions;      // JSON dan
            const progressText = document.querySelector('.progress-text');
            const progressFill = document.querySelector('.progress-fill');

            progressText.textContent = `Question ${++count} of ${totalQuestions}`;
            const quizTitle = document.querySelector('.topbar h2');
            const QuizTitle = data.quiz_title;
            quizTitle.textContent = `${QuizTitle}`;
            const percent = (count / totalQuestions) * 100;
            progressFill.style.width = percent + '%';

            // ➤ Next tugmasini Submitga aylantirish
            if (count === totalQuestions) {
                nextBtn.textContent = "Submit Quiz";
            } else {
                nextBtn.textContent = "Next →";
            }

        } catch (e) {
            console.error("Savolni yuklab bo‘lmadi:", e);
        }
    }


    // ⬇️ 2) SAVOLNI EKRANGA CHIQARISH
    function renderQuestion(q) {
        questionTitle.textContent = q.question_text;

        codeBlock.textContent = q.code ?? "";

        const html = q.options.map(opt => `
            <label class="option">
                <input type="radio" name="answer" value="${opt.id}">
                <span class="option-label">${opt.option_text}</span>
            </label>
        `).join("");

        optionsContainer.innerHTML = html;

        selectedOptionId = null;
        nextBtn.disabled = true;

        document.querySelectorAll('input[name="answer"]').forEach(r => {
            r.addEventListener('change', async (e)=> {
                selectedOptionId = e.target.value;
                const resalt = await sendAnswer();

                console.log(resalt)
                // 1) Boshqa variantlardan eski ranglarni olib tashlaymiz
                const allLabel = document.querySelectorAll('.option')
                const allInput = document.querySelectorAll('input')
                allLabel.forEach(opt => {
                    opt.classList.remove('correct', 'incorrect');
                });

                // 2) Foydalanuvchi tanlagan optionni topamiz
                const selectedLabel = e.target.closest('.option');
                const selectedInput = selectedLabel.querySelector('input');
                console.log(selectedInput);


                // 3) To‘g‘ri / noto‘g‘ri rang beramiz
                if (resalt.is_correct) {
                    selectedLabel.classList.add('correct');   // Yashil
                } else {
                    selectedLabel.classList.add('incorrect'); // Qizil
                    allLabel.forEach(item => {
                        if(item.querySelector('input').value ===  String(resalt.correct_option_id)){
                            item.classList.add('correct')

                        }
                    })
                    console.log(selectedLabel)
                }
                allInput.forEach(item=>{
                    item.disabled = true
                })
                nextBtn.disabled = false;
            });
        });
    }



    // ⬇️ 3) JAVOBNI BACKENDGA YUBORISH
    async function sendAnswer() {
        const response = await fetch('/api/attempts/answer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                attempt_id: attemptId,
                question_id: questionId,
                selected_option_id: selectedOptionId
            })
        });

        return await response.json(); // <-- response mavjud

    }

    // ⬇️ 4) NEXT BOSILGANDA
    nextBtn.addEventListener('click', async () => {
        if (!selectedOptionId) return;


        const totalQuestions = document.querySelector('.progress-text').textContent.split(' of ')[1];



        questionId++;
        loadQuestion();
    });



    // Yuqoridagi indikatorlar bo‘lsin:
    document.querySelectorAll('.indicator').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.indicator').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Submit bosilganda:
    document.querySelectorAll('.btn-primary').forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.textContent.includes('Submit')) {
                window.location.href = `/quizzes/result?attempt_id=${attemptId}`;
            }
        });
    });

    // SAHIFA OCHILGANDA 1-SAVOLNI YUKLAYMIZ
    loadQuestion();

</script>

</body>
</html>
