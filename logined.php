<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>場所情報一覧</title>
    <script>
        function redirectToHome() {
            setTimeout(function() {
                window.location.href = "http://dsais03.dsai.u-fukui.ac.jp/~exp33-24-17/index.html";
            }, 3000);
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .location-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .location-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 300px;
        }
        .location-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }
        .rating {
            color: #f39c12;
            font-weight: bold;
            font-size: 1.2em;
        }
        .user-info {
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .user-info p {
            margin: 5px 0;
        }
        .nav-links {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }
        .nav-links a {
            text-decoration: none;
            color: #fff;
            background-color: #2980b9;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }
        .nav-links a:hover {
            background-color: #3498db;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

    <?php
    session_start();
    
    if (!isset($_SESSION['name'])) {
        echo "セッションが存在しません。ログインしてください。";
        echo '<script>redirectToHome();</script>';
    } else {
        $name = $_SESSION['name'];
        $id = $_SESSION['id'];
        
        echo "<div class='user-info'>";
        echo "<p>{$name}さん、こんにちは</p>";
        echo "<p>あなたのIDは{$id}です</p>";
        echo "<div class='nav-links'>";
        echo "<a href='input.php'>新規入力</a>";
        echo "<a href='./index.html'>トップ画面</a>";
        echo "</div>";
        echo "</div>";

        try {
            
            $hostname = 'localhost';
            $username = 'webdb';
            $password = 'vTQC69P/';
            $db = 'exp33_24_17';
            
            $mysqli = new mysqli($hostname, $username, $password, $db);
            
            if ($mysqli->connect_error) {
                throw new Exception("データベース接続エラー: " . $mysqli->connect_error);
            }
            
            $mysqli->set_charset("utf8mb4");
            
            $stmt = $mysqli->prepare("SELECT spot, evaluation, picture FROM visited WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            echo("<div class='mozi'>訪れた場所</div>");
            if ($result->num_rows > 0) {
                echo "<div class='location-container'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='location-card'>";
                    echo "<h3>" . htmlspecialchars($row['spot']) . "</h3>";
                    
                    $imageData = base64_encode($row['picture']);
                    echo "<img src='data:image/jpeg;base64,{$imageData}' alt='場所の画像' class='location-image'>";
                    
                    echo "<p class='rating'>評価: ";
                    for ($i = 0; $i < $row['evaluation']; $i++) {
                        echo "★";
                    }
                    for ($i = $row['evaluation']; $i < 5; $i++) {
                        echo "☆";
                    }
                    echo " (" . $row['evaluation'] . "/5)</p>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p>登録された場所情報はありません。</p>";
            }
            
            $stmt->close();
            $mysqli->close();
            
        } catch (Exception $e) {
            echo "エラーが発生しました: " . htmlspecialchars($e->getMessage());
        }
    }
    ?>
</body>
</html>
