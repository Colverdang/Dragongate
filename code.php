<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DragonStone - Verify Code</title>

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

        .code-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }

        h2 {
            color: #1b4332;
            margin-bottom: 10px;
        }

        p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 14px;
            font-size: 20px;
            text-align: center;
            letter-spacing: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 10px;
        }

        button:hover {
            background: #222;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 8px;
        }
    </style>
</head>

<body>

<div class="code-container">
    <h2>Enter Verification Code</h2>
    <p>Please enter the 3-digit code sent to you</p>

    <input type="text" id="code" maxlength="3" placeholder="xxx">

    <div class="error" id="error"></div>

    <button id="verify">Verify</button>
</div>

<script>
    const codeInput = document.getElementById("code");
    const error = document.getElementById("error");
    const verifyBtn = document.getElementById("verify");

    verifyBtn.onclick = () => {
        error.textContent = "";

        const codeRegex = /^[0-9]{3}$/;

        if (!codeInput.value.match(codeRegex)) {
            error.textContent = "Please enter a valid 3-digit code.";
            return;
        }


        fetch("verify_code.php", {
            method: "POST",
            body: new URLSearchParams({ code: codeInput.value })
        })
        .then(res => res.json())
        .then(result => {
            if (!result.success) {
                error.textContent = result.message;
            } else {
                window.location.href = "Admin.php";
            }
        });


        alert("Code verified!");
    };
</script>

</body>
</html>
