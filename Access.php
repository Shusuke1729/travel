


<!doctype html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>福井へのアクセス</title>
    <style>
      /* ベースのスタイル設定 */
      body {
        font-family: 'Roboto', Arial, sans-serif;
        background-color: #f4f4f9;
        color: #333;
        margin: 0;
        padding: 0;
      }

       #title {
            margin-top: 0;
            background: linear-gradient(135deg, #0066cc, #ff69b4);
            position: relative;
            height: 150px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

      #title p {
            color: white;
            font-size: 50px;
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: Georgia, 'Times New Roman', Times, serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

#title a {
    position: absolute;
    bottom: 30px;
    right: 25%;
    padding: 12px 24px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.8);
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
    text-transform: uppercase;
    letter-spacing: 1px;
}

#title a:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

#title a:active {
    transform: translateY(1px);
}


      h1 {
        font-size: 40px;
        color: white;
        letter-spacing: 5px;
        margin: 0;
      }

      h2, h3, h4 {
        color: #e84a5f;
        text-align: center;
        margin-top: 20px;
        font-size: 24px;
      }

      .map-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
      }

      img {
        max-width: 80%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
      }

      .body {
        padding: 20px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 1200px; /* 最大幅を指定して中央揃え */
      }

      ul {
        list-style-type: none;
        padding-left: 0;
        margin-top: 20px;
      }

      li {
        margin-bottom: 20px;
        font-size: 18px;
      }

      p {
        margin: 5px 0;
        font-size: 16px;
        line-height: 1.6;
      }

      a {
        color: blue;
        text-decoration: none;
        font-weight: bold;
      }

      a:hover {
        text-decoration: underline;
        color: red;
      }

      /* フッターのデザイン */
      .footer {
        text-align: center;
        padding: 15px;
        background-color: #e84a5f;
        color: white;
        margin-top: 40px;
      }

      .footer a {
        color: white;
        text-decoration: none;
        font-weight: bold;
      }

      /* レスポンシブデザイン */
      @media (max-width: 768px) {
        h1 {
          font-size: 28px;
        }

        h2 {
          font-size: 22px;
        }

        h3, h4 {
          font-size: 20px;
        }

        .body {
          margin: 10px;
          padding: 15px;
        }

        img {
          max-width: 100%;
          margin-top: 10px;
        }

        .footer {
          font-size: 14px;
        }
      }
    </style>
  </head>
  <body>
    <div id="title">
	
      <p>福井へのアクセス</p>
      <a href="./index.html">ホーム</a>
    </div>

    <div class="map-container">
      <img src="https://www.fuku-e.com/access/images/accsessMap_hapilinefukui.jpg" alt="アクセス図">
    </div>

    <h2>各地から福井までの最短ルートをご紹介！</h2>

    <div class="body">
      <ul>
        <li><b>東京駅 → 福井駅</b></li>
        <p>北陸新幹線(かがやき)<br>
          所要時間: 2時間51分<br>
          料金: 15,610円</p>

        <li><b>名古屋駅 → 福井駅</b></li>
        <p>東海道新幹線(ひかり)で米原→特急しらさぎで敦賀→北陸新幹線(かがやき, はくたか, つるぎ)<br>
          所要時間: 1時間40分<br>
          料金: 8,060円</p>

        <li><b>大阪駅 → 福井駅</b></li>
        <p>特急サンダーバードで敦賀→北陸新幹線(かがやき, はくたか, つるぎ)<br>
          所要時間: 1時間50分<br>
          料金: 7,090円</p>
      </ul>

      <h3>おすすめ予約サイト</h3>
      <ul>
        <li><a href="https://e5489.jr-odekake.net/e5489/cspc/CBTopMenuPC">JR西日本e5489</a></li>
        <li><a href="https://www.eki-net.com/personal/top/index">JR東日本えきねっと</a></li>
      </ul>

      <h4>主要駅から近い観光地をご紹介！</h4>

      <!-- 駅選択フォーム -->
<form method="GET" action="">
  <select name="station" onchange="this.form.submit()">
  <option value="選択してください" <?php echo (empty($_GET['station']) || $_GET['station'] == '選択してください') ? 'selected' : ''; ?>>選択してください</option>
    <option value="福井駅" <?php echo (empty($_GET['station']) && $_GET['station'] == '福井駅') ? 'selected' : ''; ?>>福井駅</option>
    <option value="敦賀駅" <?php echo (isset($_GET['station']) && $_GET['station'] == '敦賀駅') ? 'selected' : ''; ?>>敦賀駅</option>
    <option value="あわら湯のまち駅" <?php echo (isset($_GET['station']) && $_GET['station'] == 'あわら湯のまち駅')? 'selected' : ''; ?>>あわら湯のまち駅</option>
    <option value="永平寺口駅" <?php echo (isset($_GET['station']) && $_GET['station'] == '永平寺口駅')? 'selected' : ''; ?>>永平寺口駅</option>
    <option value="勝山駅" <?php echo (isset($_GET['station']) && $_GET['station'] == '勝山駅')? 'selected' : ''; ?>>勝山駅</option>
    <option value="鯖江駅" <?php echo (isset($_GET['station']) && $_GET['station'] == '鯖江駅')? 'selected' : ''; ?>>鯖江駅</option>
    <option value="三国港駅" <?php echo (isset($_GET['station']) && $_GET['station'] == '三国港駅')? 'selected' : ''; ?>>三国港駅</option>
    <option value="越前たけふ駅" <?php echo (isset($_GET['station']) && $_GET['station'] == '越前たけふ駅')? 'selected' : ''; ?>>越前たけふ駅</option>
    <option value="武生駅" <?php echo (isset($_GET['station']) && $_GET['station'] == '武生駅')? 'selected' : ''; ?>>武生駅</option>
  </select>
</form>

      <h4><?php echo htmlspecialchars($_GET['station']); ?> 周辺の観光地</h4>

<?php
        if (isset($_GET['station'])) {
          $selected_station = $_GET['station'];

          // 各駅の緯度・経度
          $stations = [
            '福井駅' => ['latitude' => 36.06165, 'longitude' => 136.2190],
            '敦賀駅' => ['latitude' => 35.6302, 'longitude' => 136.0730],
            'あわら湯のまち駅' => ['latitude' => 36.1001, 'longitude' => 136.2220],
            '永平寺口駅' => ['latitude' => 36.1060, 'longitude' => 136.3154],
            '勝山駅' => ['latitude' => 36.0596, 'longitude' => 136.4309],
            '鯖江駅' => ['latitude' => 35.9494, 'longitude' => 136.2025],
            '三国港駅' => ['latitude' => 36.2202227, 'longitude' => 136.1400463], // 三国港駅の緯度経度
            '越前たけふ駅' => ['latitude' => 35.8955957, 'longitude' => 136.1988842], // 越前たけふ駅の緯度経度
            '武生駅' => ['latitude' => 35.903222, 'longitude' => 136.1709501] // 武生駅の緯度経度
          ];

          // データベース接続設定
          $hostname = 'localhost';
          $username = 'webdb';
          $password = 'vTQC69P/';
          $db = 'exp33_24_17';
          
          $mysqli = new mysqli($hostname, $username, $password, $db);
          if ($mysqli->connect_error) {
            die("データベース接続エラー: " . $mysqli->connect_error);
          }
          
          $query = 'SELECT * FROM kankouti';
          $result = $mysqli->query($query);
          
          if ($result) {
            $station_lat = $stations[$selected_station]['latitude'];
            $station_lon = $stations[$selected_station]['longitude'];

            echo "<ul>";
            while ($record = $result->fetch_assoc()) {
              $li = $record['latitude'];
              $lo = $record['longitude'];

              // 半径3km以内の観光地のみ表示
              if ($li >= $station_lat - 0.0246 && $li <= $station_lat + 0.0246) {
                if ($lo >= $station_lon - 0.0246 && $lo <= $station_lon + 0.0246) {
                  $place_name = htmlspecialchars($record['name']);
                  $address = htmlspecialchars($record['address']);
                  echo "<li><a href='https://www.google.com/maps/search/?api=1&query=" . urlencode($record['address'] . ' ' . $record['name']) . "' target='_blank'>";
                  echo $place_name . "</a> - " . $address . "</li>";
                  $found_places = true;
                }
              }
            }
            echo "</ul>";

            if(!$found_places){
                echo "<p>近くに観光地は見つかりませんでした</p>";
            }
          } else {
            echo "観光地情報が取得できませんでした。";
          }

        
          
          $mysqli->close();
        }
	?>

          </div>

    <div class="footer">
      <p>© 2024 福井観光</p>
    </div>
  </body>
</html>
