<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DragonStone - Login & Sign Up</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .auth-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            width: 350px;
            max-width: 90%;
            text-align: center;
        }

        h2 {
            color: #1b4332;
            margin-bottom: 15px;
        }

        input {
            padding: 12px;
            margin: 6px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 100%;
        }

        button {
            padding: 12px;
            margin-top: 15px;
            background: #40916c;
            border: none;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
        }

        button:hover {
            background: #2d6a4f;
        }

        .toggle-link {
            margin-top: 15px;
            font-size: 14px;
        }

        .toggle-link a {
            color: #1b4332;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 13px;
            color: #1b4332;
            font-weight: 600;
        }


    </style>
</head>

<body>

<div class="auth-container">

    <!-- LOGIN -->
    <div id="loginForm" class="form">
        <h2>Login</h2>

        <input type="email" id="logEmail" placeholder="Email">

        <div class="password-wrapper">
            <input type="password" id="logPassword" placeholder="Password">
            <span class="toggle-password" onclick="togglePassword('logPassword', this)">Show</span>
        </div>

        <div class="error" id="loginError"></div>

        <button>Login</button>

        <div class="toggle-link">
            Don’t have an account?
            <a onclick="toggleForms()">Sign Up</a>
        </div>
    </div>

    <!-- SIGNUP -->
    <div id="signupForm" class="form" style="display:none;">
        <h2>Sign Up</h2>

        <input type="text" placeholder="Name">
        <input type="text" placeholder="Surname">
        <input type="email" placeholder="Email">

        <div class="password-wrapper">
            <input type="password" id="password" placeholder="Confirm Password">
            <span class="toggle-password" onclick="togglePassword('password', this)">Show</span>
        </div>

        <div class="password-wrapper">
            <input type="password" id="cpassword" placeholder="Confirm Password">
            <span class="toggle-password" onclick="togglePassword('cpassword', this)">Show</span>
        </div>

        <div class="error" id="signupError"></div>

        <button>Sign Up</button>

        <div class="toggle-link">
            Already have an account?
            <a onclick="toggleForms()">Login</a>
        </div>
    </div>

</div>


<script>
    const name = document.getElementById("name");
    const surname = document.getElementById("surname");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const cpassword = document.getElementById("cpassword");

    const signupError = document.getElementById("signupError");

    const logEmail = document.getElementById("logEmail");
    const logPassword = document.getElementById("logPassword");
    const loginError = document.getElementById("loginError");

    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");

    function toggleForms() {
    loginForm.style.display = loginForm.style.display === "none" ? "block" : "none";
    signupForm.style.display = signupForm.style.display === "none" ? "block" : "none";
}

function togglePassword(id, el) {
    const input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
    el.textContent = input.type === "password" ? "Show" : "Hide";
}

const btnlogin = document.getElementById("login");
const btnsignup = document.getElementById("signup");

btnsignup.onclick = () => {
    signupError.textContent = "";

    const nameRegex = /^[A-Za-z]+$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-+={}[\]|:;,.<>?\/]).{8,}$/;


    if (!name.value.match(nameRegex))
        return signupError.textContent = "Name must contain letters only.";

    if (!surname.value.match(nameRegex))
        return signupError.textContent = "Surname must contain letters only.";

    if (!email.value.match(emailRegex))
        return signupError.textContent = "Invalid email address.";

    if (!password.value.match(passwordRegex))
        return signupError.textContent = "Password must be at least 8 characters and include uppercase, lowercase, number, and special character.";

    if (password.value !== cpassword.value)
        return signupError.textContent = "Passwords do not match.";

    const data = new URLSearchParams({
        name: name.value,
        surname: surname.value,
        email: email.value,
        password: password.value,
        cpassword: cpassword.value,
    });

    fetch("../register_account.php", { method: "POST", body: data })
        .then(res => res.json())
        .then(result => {
            if (!result.success) {
                signupError.textContent = result.message;
            } else {
                alert("Account created successfully!");
                toggleForms();
            }
        });
};

///////STARRRRRTTTT??????////////
///////STARRRRRTTTT??????////////
///////STARRRRRTTTT??????////////
///////STARRRRRkTTTT??????////////
///////STARRRRRkTTTT??????////////
///////STARRRRRkTTTT??????////////
///////STARRRRRkTTTT??????////////

btnlogin.onclick = () => {
    loginError.textContent = "";

    const data = new URLSearchParams({
        email: logEmail.value,
        password: logPassword.value
    });

    fetch("../loginAuth.php", { method: "POST", body: data })
        .then(res => res.json())
        .then(result => {
            if (!result.success) {
                loginError.textContent = result.message;
            } else {
                window.location.href = "../Home/Homepage.php";
            }
        });
};
</script>

</body>
</html>




