<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
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
            top: 5px;
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
            background-color:
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
        p {
            margin-top: 15px;
        }

        .kotira a:hover{
            color: orange;
        }

        
    </style>
</head>
<body>
<div class="main">
    <nav>
        <ul><a href="./index.html">トップ画面</a></ul>
    </nav>
    <div class="title">
        <h1>ログイン</h1>
    </div>
    <form action="./login.php" method="post">
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
        <input type="submit" value="ログイン">
    </form>
    <br>
    <p><b>まだ登録してない方は<a href="sig.php"><font color="red">こちら</font></a>をクリック</b></p></div>
</div>
</body>
</html>
