<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Registrierung</title>
    <link rel="stylesheet" href="stylesheet.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #F9F9F9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .login-container {
            max-width: 400px;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .login-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .login-header h1 {
            font-size: 1.8rem;
            color: #294936;
            margin: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            border-color: #294936;
            outline: none;
        }

        .form-group button {
            width: 100%;
            padding: 0.75rem;
            background-color: #294936;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.2s;
        }

        .form-group button:hover {
            background-color: #3E6259;
        }

        .toggle-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            font-size: 1rem;
            color: #294936;
            text-decoration: underline;
            cursor: pointer;
        }

        .toggle-link:hover {
            color: #3E6259;
        }

        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: -0.5rem;
            margin-bottom: 1rem;
            display: none;
        }

        header {
            background-color: #294936;
            width: 100%;
            height: 56px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background-color: #294936;
            color: white;
            margin-top: 2rem;
            width: 100%;
            padding-left: 0px;
            padding-right: 0px;
        }

        footer a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 0.5rem;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .header-logo img {
            height: 60px;
        }

        .header-logo {

            display: flex;
            justify-content: center;
            align-items: center;
            padding-left: 0px;
            padding-right: 0px;
        }

    </style>
</head>
<body>

    <?php include 'components/header.php'; ?>

    <!-- Login / Registrierung -->
    <div class="login-container">
        <div class="login-header">
            <h1>Login</h1>
        </div>

        <form id="login-form" onsubmit="return validateLogin()">
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" id="email" name="email" required>
                <div class="error-message" id="login-email-error">Bitte geben Sie eine gültige E-Mail-Adresse ein.</div>
            </div>
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" id="password" name="password" required>
                <div class="error-message" id="login-password-error">Bitte geben Sie ein Passwort ein.</div>
            </div>
            <div class="form-group">
                <button type="submit">Einloggen</button>
            </div>
        </form>

        <div class="toggle-link" onclick="toggleForm()" style="margin-bottom: 16px;">Noch kein Konto? Jetzt registrieren</div>

        <form id="register-form" style="display: none;" onsubmit="return validateRegister()">
            <div class="form-group">
                <label for="username">Benutzername</label>
                <input type="text" id="username" name="username" required>
                <div class="error-message" id="register-username-error">Bitte geben Sie einen Benutzernamen ein.</div>
            </div>
            <div class="form-group">
                <label for="register-email">E-Mail</label>
                <input type="email" id="register-email" name="email" required>
                <div class="error-message" id="register-email-error">Bitte geben Sie eine gültige E-Mail-Adresse ein.</div>
            </div>
            <div class="form-group">
                <label for="register-password">Passwort</label>
                <input type="password" id="register-password" name="password" required>
                <div class="error-message" id="register-password-error">Bitte geben Sie ein Passwort ein.</div>
            </div>
            <div class="form-group">
                <label for="confirm-password">Passwort bestätigen</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
                <div class="error-message" id="confirm-password-error">Passwörter stimmen nicht überein.</div>
            </div>
            <div class="form-group">
                <button type="submit">Registrieren</button>
            </div>
        </form>
    </div>

    <script>
        function toggleForm() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const toggleLink = document.querySelector('.toggle-link');

            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
                toggleLink.textContent = 'Noch kein Konto? Jetzt registrieren';
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                toggleLink.textContent = 'Bereits ein Konto? Jetzt einloggen';
            }
        }

        function validateLogin() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const emailError = document.getElementById('login-email-error');
            const passwordError = document.getElementById('login-password-error');

            let isValid = true;

            if (!email) {
                emailError.style.display = 'block';
                isValid = false;
            } else {
                emailError.style.display = 'none';
            }

            if (!password) {
                passwordError.style.display = 'block';
                isValid = false;
            } else {
                passwordError.style.display = 'none';
            }

            if (isValid) {
                window.location.href = 'index.php';
            }

            return isValid;
        }

        function validateRegister() {
            const email = document.getElementById('register-email').value;
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const emailError = document.getElementById('register-email-error');
            const passwordError = document.getElementById('register-password-error');
            const confirmPasswordError = document.getElementById('confirm-password-error');

            let isValid = true;

            if (!email) {
                emailError.style.display = 'block';
                isValid = false;
            } else {
                emailError.style.display = 'none';
            }

            if (!password) {
                passwordError.style.display = 'block';
                isValid = false;
            } else {
                passwordError.style.display = 'none';
            }

            if (password !== confirmPassword) {
                confirmPasswordError.style.display = 'block';
                isValid = false;
            } else {
                confirmPasswordError.style.display = 'none';
            }

            if (isValid) {
                window.location.href = 'index.php';
            }

            return isValid;
        }
    </script>

    <?php include 'components/footer.php'; ?>
</body>
</html>