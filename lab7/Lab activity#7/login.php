<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #0c0c0c, #222);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
        }

        .nav-sidebar {
            width: 20%;
            padding: 50px;
        }

        .toggle-text {
            cursor: pointer;
            margin-bottom: 20px;
        }

        .login-container {
            width: 50%;
            margin: 10% auto;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            padding: 50px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
            display: flex;
            justify-content: center;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-control {
            background: transparent;
            color: white;
            border: none;
            border-bottom: 2px solid #4287f5;
            border-radius: 0;
            padding: 20px 0;
            font-size: 20px;
        }

        .form-control::placeholder {
            color: #4287f5;
        }

        .form-control:focus {
            border-color: #02b875;
        }

        .btn-login {
            background: #02b875;
            border: none;
            border-radius: 5px;
            padding: 20px 40px;
            font-size: 18px;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #02855b;
        }

        .image-container {
            flex: 1;
        }

        .image-container img {
            width: 100%;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="nav-sidebar">
        <div class="toggle-text" onclick="toggleForm('login')">Login</div>
        <div class="toggle-text" onclick="toggleForm('register')">Register</div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 login-container" id="login-container">
                <div class="image-container">
                    <img src="assets/basclogo.png" alt="Login Image">
                </div>

                <div class="login-form" style="flex: 1; padding-left: 50px; padding-right: 50px;">
                    <h2 class="text-center text-success" id="form-title">LOGIN</h2>
                    <form id="login-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="EMAIL ADDRESS" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="PASSWORD" required>
                        </div>
                        <div class="text-center">
                            <a href="index.php">
                                <button type="button" class="btn btn-login mx-auto">Sign in</button>
                            </a>
                        </div>
                    </form>

                    <form id="register-form" style="display:none;">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="BARCODE" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="FULL NAME" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="COURSE" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="CLASS SCHEDULE" required>
                        </div>
                        <div class="text-center">
                            <a href="index.php">
                                <button type="button" class="btn btn-login mx-auto">Register</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <script src="js/bootstrap.min.js"></script>
    <script>
    function toggleForm(formType) {
        var loginForm = document.getElementById('login-form');
        var registerForm = document.getElementById('register-form');
        var formTitle = document.getElementById('form-title');
        if (formType === 'login') {
            loginForm.style.display = 'block';
            registerForm.style.display = 'none';
            formTitle.innerText = 'LOGIN';
        } else if (formType === 'register') {
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
            formTitle.innerText = 'REGISTER';
        }
    }

    const loginButton = document.querySelector('#login-form button');
    loginButton.addEventListener('click', function (event) {
        const email = document.querySelector('#login-form input[type="text"]');
        const password = document.querySelector('#login-form input[type="password"]');
        if (!email.value || !password.value) {
            event.preventDefault();
            const error = document.createElement('p');
            error.classList.add('error');
            error.textContent = 'Please fill in all fields.';
            loginForm.appendChild(error);
        }
    });

    const registerButton = document.querySelector('#register-form button');
    registerButton.textContent = 'Sign Up';

    registerButton.addEventListener('click', function (event) {
        const barcode = document.querySelector('#register-form input:nth-of-type(1)');
        const fullName = document.querySelector('#register-form input:nth-of-type(2)');
        const course = document.querySelector('#register-form input:nth-of-type(3)');
        const classSchedule = document.querySelector('#register-form input:nth-of-type(4)');

        if (!barcode.value || !fullName.value || !course.value || !classSchedule.value) {
            event.preventDefault();
            const error = document.createElement('p');
            error.classList.add('error');
            error.textContent = 'Please fill in all fields.';
            registerForm.appendChild(error);
        }
    });
    </script>
</body>
</html>
