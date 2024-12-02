<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>場所評価フォーム</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f3f3f3;
        }
        .form-container {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .form-container h2 {
            margin-top: 0;
            font-size: 24px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group select,
        .form-group input[type="file"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
    </style>

    <script>
        function redirectToHome() {
            setTimeout(function() {
                window.location.href = "http://dsais03.dsai.u-fukui.ac.jp/~exp33-24-17/index.html";
            }, 3000);
        }
    </script>
</head>
<body>

<?php
    // $id = $_GET["id"]; // URLからIDを取得
    session_start();
    
    if (!isset($_SESSION['name'])) {
        echo "セッションが存在しません。ログインしてください。";
        echo '<script>redirectToHome();</script>';
        exif(1);
    } else {
        $id = $_SESSION['id'];
    }
?>

<div class="form-container">
    <h2>場所評価フォーム</h2>
    <form id="locationForm" method="POST" action="submit.php" enctype="multipart/form-data">
        <!-- 隠しフィールドにIDを含める -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <div class="form-group">
            <label for="locationName">場所の名前</label>
            <input type="text" id="locationName" name="locationName" required>
        </div>
        <div class="form-group">
            <label for="rating">評価 (1〜5)</label>
            <select id="rating" name="rating" required>
                <option value="" disabled selected>選択してください</option>
                <option value="1">1 - とても悪い</option>
                <option value="2">2 - 悪い</option>
                <option value="3">3 - 普通</option>
                <option value="4">4 - 良い</option>
                <option value="5">5 - とても良い</option>
            </select>
        </div>
        <div class="form-group">
            <label for="locationImage">画像をアップロード</label>
            <input type="file" id="image" name="locationImage" accept="image/*" required>
        </div>
        <div class="form-group">
            <button type="submit">送信</button>
        </div>
    </form>
</div>

</body>
</html>
