<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送信処理</title>
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $hostname = 'localhost';
    $username = 'webdb';
    $password = 'vTQC69P/';
    $db = 'exp33_24_17';

    try {
        $mysqli = new mysqli($hostname, $username, $password, $db);

        if ($mysqli->connect_error) {
            throw new Exception("データベース接続エラー: " . $mysqli->connect_error);
        }

        $mysqli->set_charset("utf8mb4");

        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $spot = htmlspecialchars(trim($_POST['locationName']), ENT_QUOTES, 'UTF-8');
        $rating = filter_var($_POST['rating'], FILTER_SANITIZE_NUMBER_INT);

        if (isset($_FILES['locationImage']) && $_FILES['locationImage']['error'] === UPLOAD_ERR_OK) {
            $image_data = file_get_contents($_FILES['locationImage']['tmp_name']);

            if ($image_data === false) {
                throw new Exception("画像ファイルの読み込みに失敗しました。");
            }

            $stmt = $mysqli->prepare("INSERT INTO visited (id, spot, evaluation, picture) VALUES (?, ?, ?, ?)");

            if ($stmt === false) {
                throw new Exception("プリペアドステートメントの作成に失敗しました: " . $mysqli->error);
            }

            $stmt->bind_param("isib", $id, $spot, $rating, $null);
            $stmt->send_long_data(3, $image_data);

            if ($stmt->execute()) {
                echo "データが正常に保存されました。<br>";

                echo "<h3>アップロードされた画像：</h3>";
                echo '<img src="data:image/jpeg;base64,' . base64_encode($image_data) . '" style="max-width: 300px; height: auto;">';
            } else {
                throw new Exception("データの保存に失敗しました: " . $stmt->error);
            }

            $stmt->close();
        } else {
            $error_message = "";
            switch ($_FILES['locationImage']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    $error_message = "ファイルサイズがPHPの制限を超えています。";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $error_message = "ファイルサイズがフォームの制限を超えています。";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $error_message = "ファイルの一部のみがアップロードされました。";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $error_message = "ファイルがアップロードされませんでした。";
                    break;
                default:
                    $error_message = "エラーコード: " . $_FILES['locationImage']['error'];
            }
            throw new Exception("画像のアップロードに失敗しました: " . $error_message);
        }

        $mysqli->close();

    } catch (Exception $e) {
        echo "エラーが発生しました: " . htmlspecialchars($e->getMessage());
    }
?>

<div style="margin-top: 20px;">
    <a href="input.php" class="button">入力画面に戻る</a>
    <a href="logined.php" class="button">ログイン画面に戻る</a>
</div>

</body>
</html>
