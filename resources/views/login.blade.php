<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - QuizMaster</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="login-page">
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <span class="logo-icon">📚</span>
                <h1>QuizMaster</h1>
            </div>
            <form class="login-form">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" placeholder="your@email.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Enter your password" required>
                </div>
                <div class="form-options">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <div class="login-footer">
                <p>Boshsahifaga qaytasizmi? <a href="/" class="signup-link">Boshsahifa</a></p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

    document.querySelector('.login-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        try {
            const response = await axios.post("/api/login", {
                email: email,
                password: password
            });

            // Token olish
            const token = response.data.token;
            const userName = response.data.user.name;
            // Tokenni browserga saqlab qo'yamiz
            localStorage.setItem("token", token);
            localStorage.setItem('userName', userName);
            // Dashboardga o'tkazamiz
            window.location.href = "/dashboard";

        } catch (error) {
            alert("Email yoki parol noto‘g‘ri!");
            console.error(error);
        }
    });
</script>

</body>
</html>
