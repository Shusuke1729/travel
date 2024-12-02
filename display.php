<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>近くの観光地、グルメ</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            margin-left: 100px;
            margin-top: 100px;
        }

        

        .container {
            width: 100%;
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            white-space: nowrap;
        }

        .box {
            width: 400px;
            height: auto; 
            border-radius: 10px;
            padding: 10px; 
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s;
        }

        .food {
            background: #dbedff;
        }

        .hotel {
            background: #ffeaff;
        }

        a {
            text-decoration: none;
            transition: 150ms;
        }

        a:hover {
            color: #ff4500;
        }

        .title {
            font-family: Georgia, 'Times New Roman', Times, serif;
            background: white;
            width: 500px;
        }

        .title p {
            font-size: 18px;
        }

        .map-link a{
            text-decoration: none;
            transition: 150ms;
            color: #4CAF50;;
        }

        .hotel b {
            color: brown;
        }

        .food b {
            color: #606060;
        }

        .mozi {
            font-size: 20px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    
    <?php
        $hostname = 'localhost';
        $username = 'webdb';
        $password = 'vTQC69P/';
        $db = 'exp33_24_17';

        $mysqli = new mysqli($hostname, $username, $password, $db);
        $city = $_GET['city'];
        $address = $_GET['address'];
        $spot = $_GET['spot'];

        $query = 'select name,kubun2 from kankouti';
        $result = $mysqli->query($query);
        for ($i = 0; $i < $result->num_rows; $i++) {
            $result->data_seek($i);
            $record = $result->fetch_assoc();

            if($spot === $record['name']) {
                $class = $record['kubun2'];
                break;
            }
        }
        echo("<div class='title'>");
        echo("<h1>$spot</h1>" . "<br>");
        echo("<p>住所 :　　　");
        echo "<a class='map-link' href='https://www.google.com/maps/search/?api=1&query=" . urlencode($address.$spot) . "' target='_blank'>" . $address . "</a><br>";
        echo("分類 :　　　");
        echo("$class </p>");
        echo("<br><br>" );
        echo("</div>");
        echo("<br>");
        echo("<div class='mozi'>");
        echo("近くの旅館<br>");
        echo("</div>");

        $query = 'select * from ryokan';
        $result = $mysqli->query($query);

        echo "<div class='container'>";  // コンテナを開始
        for ($i = 0; $i < $result->num_rows; $i++) {
            $result->data_seek($i);
            $record = $result->fetch_assoc();

            if (strpos($record['address'], $city) !== false) {
                echo "<div class='box hotel'>";
                echo "<b>";
                echo $record['name'] . "</b><br>";
                echo "住所　　　<a class='map-link' href='https://www.google.com/maps/search/?api=1&query=" . urlencode($record['address'].$record['name']) . "' target='_blank'>" . $record['address'] . "</a><br>";
                echo "電話番号　" . $record['phone'] . "<br><br>";
                echo "</div>";
            }
        }
        echo "</div><br>";
        if($city === "福井市") {
            echo("データがありませんでした<br><br><br>");
        }
        echo("<div class='mozi'>");
        echo("近くのグルメ<br>");
        echo("</div>");
        $query = 'select * from food';
        $result = $mysqli->query($query);

        echo "<div class='container'>";  // コンテナを開始
        for ($i = 0; $i < $result->num_rows; $i++) {
            $result->data_seek($i);
            $record = $result->fetch_assoc();

            if (strpos($record['address'], $city) !== false && $record['kubun'] === '飲食店') {
                echo "<div class='box food'>";
                echo "<b>";
                echo $record['name'] . "</b><br>";
                echo "料理　　　" . $record['menu'] . "<br>";
                echo "住所　　　<a class='map-link' href='https://www.google.com/maps/search/?api=1&query=" . urlencode($record['address'].$record['name']) . "' target='_blank'>" . $record['address'] . "</a><br>";
                echo "電話番号　" . $record['telephone_number'] . "<br><br>";
                echo "</div>";
            }
        }
        echo "</div>";
    ?>
</body>
</html>
