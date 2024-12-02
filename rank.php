<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$hostname = 'localhost';
$username = 'webdb';
$password = 'vTQC69P/';
$db = 'exp33_24_17';

$mysqli = new mysqli($hostname, $username, $password, $db);

if (!$mysqli->set_charset("utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", $mysqli->error);
    exit();
}

$query = 'SELECT spot, COUNT(*) AS number, AVG(evaluation) AS avg_rating 
          FROM visited 
          GROUP BY spot 
          HAVING AVG(evaluation) >= 3 
          ORDER BY avg_rating DESC';
$result = $mysqli->query($query);

if (!$result) {
    printf("Query error: %s\n", $mysqli->error);
    exit();
}

$spots = [];
while ($record = $result->fetch_assoc()) {
    $spotName = $record['spot'];
    $ratingQuery = $mysqli->prepare("SELECT evaluation FROM visited WHERE spot = ?");
    $ratingQuery->bind_param("s", $spotName);
    $ratingQuery->execute();
    $ratingResult = $ratingQuery->get_result();
    
    $distribution = array_fill(0, 5, 0);  // 1から5の評価数を0で初期化
    while ($ratingRecord = $ratingResult->fetch_assoc()) {
        $evaluation = (int)$ratingRecord['evaluation'];
        if ($evaluation >= 1 && $evaluation <= 5) {
            $distribution[$evaluation - 1]++;
        }
    }

    $spots[] = [
        'spot' => $record['spot'],
        'avg_rating' => number_format($record['avg_rating'], 1),
        'number' => $record['number'],
        'stars' => str_repeat('★', round($record['avg_rating'])),
        'distribution' => $distribution
    ];

    $ratingQuery->close();
}

$result->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>人気観光スポット</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
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

        h2 {
            text-align: center;
            color: #333;
            margin: 30px 0;
            font-size: 24px;
            padding: 10px;
        }

        .spots-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .spot-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s;
            cursor: pointer;
        }

        .spot-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .spot-name {
            font-size: 20px;
            color: #333;
            font-weight: bold;
        }

        .visitor-count {
            background: #0066cc;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 16px;
        }

        .average-rating {
            color: #666;
            font-size: 16px;
            margin-top: 5px;
        }

        .star-rating {
            color: #ffd700;
            margin-left: 10px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            width: 80%;
            text-align: center;
            animation: fadeIn 0.3s ease;
        }

        .chart-container {
            width: 300px;
            margin: 0 auto;
            position: relative;
            height: 200px;
        }

        .close-button {
            background-color: #0066cc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .close-button:hover {
            background-color: #004c99;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div id="title">
        <p>人気スポット</p>
    </div>

    <h2>評価の平均が3以上のスポット</h2>

    <div class="spots-container" id="spots-container">
        <?php foreach ($spots as $spot): ?>
            <div class="spot-card" onclick='openModal(<?php echo json_encode($spot, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'>
                <div>
                    <div class="spot-name"><?php echo htmlspecialchars($spot['spot']); ?></div>
                    <div class="average-rating">評価: <?php echo htmlspecialchars($spot['avg_rating']); ?>
                        <span class="star-rating"><?php echo htmlspecialchars($spot['stars']); ?></span>
                    </div>
                </div>
                <div class="visitor-count">
                    訪問者数: <?php echo number_format($spot['number']); ?>人
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <h2 id="modal-spot-name"></h2>
            <p>評価: <span id="modal-avg-rating"></span></p>
            <p>訪問者数: <span id="modal-visitor-count"></span>人</p>
            <h3>評価分布</h3>
            <div class="chart-container">
                <canvas id="ratingChart"></canvas>
            </div>
            <button class="close-button" onclick="closeModal()">閉じる</button>
        </div>
    </div>

    <script>
        let ratingChart = null;

        function openModal(spot) {
            document.getElementById("modal-spot-name").textContent = spot.spot;
            document.getElementById("modal-avg-rating").textContent = spot.avg_rating;
            document.getElementById("modal-visitor-count").textContent = new Intl.NumberFormat('ja-JP').format(spot.number);

            const ctx = document.getElementById('ratingChart').getContext('2d');

            if (ratingChart) {
                ratingChart.destroy();
            }

            ratingChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['1点', '2点', '3点', '4点', '5点'],
                    datasets: [{
                        label: '評価数',
                        data: spot.distribution,
                        backgroundColor: [
                            '#ffcccb',
                            '#ff9999',
                            '#ff6666',
                            '#ff3333',
                            '#ff0000'
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 1,
                        barPercentage: 0.8,  // バーの幅を調整
                        categoryPercentage: 0.9  // カテゴリの幅を調整
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            document.getElementById("modal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }

        window.onclick = function(event) {
            const modal = document.getElementById("modal");
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
