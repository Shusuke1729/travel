<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        center {
            margin-top: 450px;
        }

        p {
            font-size: 20px;
        }
    </style>
</head>
<body>
<?php
//フォームからの値をそれぞれ変数に代入
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $name = $_POST['name'];
    $hashedkey = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $hostname = 'localhost';
    $username = 'webdb';
    $password = 'vTQC69P/';
    $db = 'exp33_24_17';
    $mysqli = mysqli_connect($hostname, $username, $password, $db);
    $mysqli->set_charset('utf8');
    

    $sql = "INSERT INTO users (name, pass) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $name, $hashedkey);

    $stmt->execute();
    $msg = '会員登録が完了しました';
    $link = '<a href="login_form.php">ログインページ</a>';
?>

<center><p><?php echo($msg);?></p>
<br>
        <?php echo($link);?>
</center>
</body>
</html>
