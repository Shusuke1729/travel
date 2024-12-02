<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .main {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .body {
            position: absolute; 
            top: 300px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <div class="main">
<?php
    session_start();
    $name = $_POST['name'];
    

    $hostname = 'localhost';
    $username = 'webdb';
    $password = 'vTQC69P/';
    $db = 'exp33_24_17';

    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $mysqli = new mysqli($hostname, $username, $password, $db);
    $sql = "SELECT * FROM users WHERE name=\"{$name}\"";
    $member = $mysqli->query($sql);
    if($member->num_rows == 0) {
        echo("<div class='body'>");
            echo("<h3>ログイン失敗</h3>");
            echo("そのようなユーザは存在しません<br>");
            $link = '<a href="login_form.php">戻る</a>';
            echo($link);
        echo("</div>");
            return;
    }
    $i = 0;
    for ($i = 0; $i < $member->num_rows; $i++){
        $member->data_seek($i);
        $record = $member->fetch_assoc();
        $user_raw_pass = $_POST['pass'];
        $db_hashed_pass = $record['pass'];
        echo("<div class='body'>");
        if (password_verify($user_raw_pass,$db_hashed_pass)) {
            $_SESSION['id'] = $record['id'];
            $_SESSION['name'] = $record['name'];
            $msg = 'ログイン成功しました。';
            echo("<h3> $msg </h3>");
            $link = '<a href="logined.php">ホーム</a>';
            echo($link);
            break;

        } else {
            
        }
        echo("</div>");
    }
    if($i === $member->num_rows) {
        echo("<div class='body'>");
        echo("<h3>ログイン失敗</h3>");
            echo("パスワードが異なります<br>");
            $link = '<a href="login_form.php">戻る</a>';
            echo($link);
        echo("</div>");  
    }
?>

</div>

</body>
</html>
