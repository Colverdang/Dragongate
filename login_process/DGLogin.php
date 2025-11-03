<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DragonStone - Login & Sign Up</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f7f5;
      color: #333;
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
    }
    .auth-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #1b4332;
    }
    .auth-container form {
      display: flex;
      flex-direction: column;
    }
    .auth-container input[type="text"],
    .auth-container input[type="email"],
    .auth-container input[type="password"] {
      padding: 12px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    .auth-container button {
      padding: 12px;
      margin-top: 15px;
      background: #40916c;
      border: none;
      color: #fff;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
    }
    .auth-container button:hover {
      background: #2d6a4f;
    }
    .toggle-link {
      text-align: center;
      margin-top: 15px;
    }
    .toggle-link a {
      color: #1b4332;
      text-decoration: none;
      font-weight: 600;
    }
    .toggle-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="auth-container" id="loginForm">
    <h2>Login</h2>
    <form>
      <input type="email" placeholder="Email" required>
      <input type="password" placeholder="Password" required>
      <button id="login">Login</button>
    </form>
    <div class="toggle-link">
      <p>Don't have an account? <a href="#" onclick="toggleForms()">Sign Up</a></p>
    </div>
  </div>

  <div class="auth-container" id="signupForm" style="display:none;">
    <h2>Sign Up</h2>
    <form>
      <input type="text" id="name" placeholder="Name" required>
      <input type="text" id="surname" placeholder="Surname" required>
      <input type="email" id="email" placeholder="Email" required>
      <input type="password" id="password" placeholder="Password" required>
      <input type="password" id="cpassword" placeholder="Confirm Password" required>
      <button id="signup" type="button">Sign Up</button>
    </form>
    <div class="toggle-link">
      <p>Already have an account? <a href="#" onclick="toggleForms()">Login</a></p>
    </div>
  </div>

  <script>
    function toggleForms() {
      const loginForm = document.getElementById('loginForm');
      const signupForm = document.getElementById('signupForm');
      if (loginForm.style.display === 'none') {
        loginForm.style.display = 'block';
        signupForm.style.display = 'none';
      } else {
        loginForm.style.display = 'none';
        signupForm.style.display = 'block';
      }
    }
  </script>
</body>
</html>
