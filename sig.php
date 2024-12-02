<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録ページ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .main {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            position: relative;
        }
        .title {
            text-align: center;
            margin-bottom: 20px;
        }
        nav {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            gap: 15px;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            transition: color 0.3s;
        }
        a:hover {
            color: orange;
        }
        label {
            display: block;
            margin: 10px 0;
        }
        input[type="text"], input[type="password"] {
            width: 93%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 5px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>

    <script>
        function validatePassword() {
            const password = document.querySelector('input[name="pass"]').value;
            const passwordPattern = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;

            if (!passwordPattern.test(password)) {
                alert("パスワードは8文字以上で、英字と数字を含む必要があります。");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

<div class="main">
    <nav>
        <a href="./login_form.php">ログイン</a>
        <a href="./index.html">トップ画面</a>
    </nav>
    
    <div class="title">
        <h1>新規登録</h1>
        <p><b>パスワードは8文字以上で、英語と数字を含めてください</b></p>
    </div>

    <form action="reg.php" method="post" onsubmit="return validatePassword();">
        <div>
            <label>
                名前：　　　
                <input type="text" name="name" required>
            </label>
        </div>

        <div>
            <label>
                パスワード：
                <input type="password" name="pass" required minlength="8">
            </label>
        </div>
        <br>
        <input type="submit" value="新規登録">
    </form>
</div>

</body>
</html>
