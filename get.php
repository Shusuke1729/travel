<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>観光</title>
    <style>
        
        #title {
            margin-top: 75px;
            margin-left: 15px;
            background: linear-gradient(to right, blue, pink);
            position: relative;
            height: 150px;
        }
        #title p {
            color: white;
            font-size: 50px;
            text-align: center;
            display: flex;
            left: 50px;
            position: absolute;
            align-items: center;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        .main {
            margin-top: 40px;
            color: black;
            margin-left: 25px;
            display: flex; 
            flex-wrap: wrap; 
            gap: 15px; 
        }
        .main p {
            font-size: 23px;
            padding: 5px;
            background: green;
            color: white;
            height: 40px;
            text-align: center;
            display: flex;
            align-items: center;
            width: calc(90% - 15px); 
            margin-right: 0; 
            font-family: Georgia, 'Times New Roman', Times, serif;
        }
        .box {
            width: 400px;
            height: auto; 
            background: #eaeaff;
            border-radius: 10px;
            padding: 10px; 
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s;
        }


        .tmp  {
            font-weight: bold;
            font-size: 20px;
            color: #606060;
        }

        a {
            text-decoration: none;
            transition: 150ms
        }

        a:hover {
            color: #ff4500;
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
        $city = $_GET["city"];
        $travel = $_GET["travel"]; // travelの中には観光地, グルメ, 旅館が入る

        echo "<div id='title'>";
        echo "<p>";
        echo($city);
        echo "の"; 
        echo $travel;
        echo "</p>";
        echo "</div>";
        echo "<div class='main'>";
        if ($travel == "観光地") {
            $query = 'select * from kankouti';
            $result = $mysqli->query($query);

            echo "<p>観光地名<br></p>";
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $record = $result->fetch_assoc();

                if (strpos($record['address'], $city) !== false) {
                    echo "<div class='box'>";
                    echo("<div class='tmp'>");
                    echo "<a href=display.php?city=";
                    echo  $_GET["city"] ,"&address=",$record["address"], "&travel=",$_GET["travel"], "&spot=",$record["name"],">";
                    echo $record['name']."</a><br>";
                    echo("</div>");
                    echo "住所　　　<a class='map-link' href='https://www.google.com/maps/search/?api=1&query=" . urlencode($record['address'].$record['name']) . "' target='_blank'>" . $record['address'] . "</a><br>";
                    echo $record['kubun2']. "<br>".$record['kubun3'];
                    echo "<br><br>";
                    echo "</div>";
                }
            }
        } else if ($travel == "グルメ") {
            
            $query = 'select * from food';
            $result = $mysqli->query($query);

            echo "<p>店舗名<br></p>";
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $record = $result->fetch_assoc();

                if (strpos($record['address'], $city) !== false && $record['kubun'] === '飲食店') {
                    echo "<div class='box'>";
                    echo "<div class='tmp'>";
                    echo $record['name'] . "</div><br>";
                    echo "料理　　　" . $record['menu'] . "<br>";
                    echo "住所　　　<a class='map-link' href='https://www.google.com/maps/search/?api=1&query=" . urlencode($record['address'].$record['name']) . "' target='_blank'>" . $record['address'] . "</a><br>";
                    echo "営業時間　" . $record['time'] . "<br>";
                    echo "休業日　" . $record['day'] . "<br>";
                    echo "電話番号　" . $record['telephone_number'] . "<br><br>";
                    echo "</div>";
                }

            }
        } else {
            $query = 'select * from ryokan';
            $result = $mysqli->query($query);

            echo "<p>旅館名<br></p>";
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $record = $result->fetch_assoc();

                if (strpos($record['address'], $city) !== false) {
                    echo "<div class='box'>";
                    echo "<div class='tmp'>";
                    echo $record['name'] . "</div><br>";
                    echo "住所　　　<a class='map-link' href='https://www.google.com/maps/search/?api=1&query=" . urlencode($record['address'].$record['name']) . "' target='_blank'>" . $record['address'] . "</a><br>";
                    echo "電話番号　" . $record['phone'] . "<br><br>";
                    echo "</div>";
                }
            }

            if($city === '福井市') {
                echo "<h3>該当するものはありません<h3>";
            }
        }

        $mysqli->close();
        echo "</div>";
    ?>  
    <br>
    <a href="./index.html">戻る</a>
</body>
</html>
