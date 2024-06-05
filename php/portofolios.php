<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portofolio Cryptocurrency</title>
  <link rel="icon" type="image/png" href="../image/cryptotracker.png">
  <link href="../css/cryptofont/nav.css" rel="stylesheet">
  <link href="../css/cryptofont/cryptofont.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
        .portfolio-item {
            display: flex;
            align-items: center;
            margin-bottom: 50px;
            justify-content: center;
        }

        .portfolio-details {
            flex: 1;
            text-align: center;
        }
  </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../image/cryptotracker.png" alt="Cryptotracker" width="30" height="30">
                Cryptotracker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><i class="fas fa-newspaper"></i> Portofolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="topnews.php"><i class="fas fa-newspaper"></i> Top News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-chart-line"></i> Main</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <h1 style="text-align: center;">Portofolio Cryptocurrency</h1>
    <?php
    // Nama file JSON
    $filename = '../json/portofolio.json';

    // Periksa apakah file ada
    if (file_exists($filename)) {
        // Baca konten file
        $jsonContent = file_get_contents($filename);

        // Decode JSON ke array
        $portfolio = json_decode($jsonContent, true);

        // Periksa apakah decoding berhasil
        if (json_last_error() === JSON_ERROR_NONE) {
            // Loop through the portfolio data
            foreach ($portfolio as $coin) {
                echo '<div class="portfolio-item">';
                echo <<<EOT
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                    {
                        "symbol": "
EOT;
                echo $coin['market'] . ":" . $coin['symbol'];
                echo <<<EOT
                        ",
                        "width": 600,
                        "height": 300,
                        "locale": "en",
                        "dateRange": "12M",
                        "colorTheme": "light",
                        "isTransparent": true,
                        "autosize": false,
                        "largeChartUrl": "",
                        "noTimeScale": true
                    }
                    </script>
                </div>
EOT;
                echo '<div class="portfolio-details">';
                echo '<h2>' . $coin['name'] . '</h2>';
                echo '<p>JUMLAH: ' . $coin['owned'] . '</p>';
                echo '<p>NILAI SATUAN: ' . number_format($coin['curPrice'], 0, '.', ',') . '$</p>';
                echo '<p>NILAI TOTAL: ' . number_format($coin['owned'] * $coin['curPrice'], 0, '.', ',') . '$</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            // Tampilkan pesan kesalahan jika decoding gagal
            echo 'Error decoding JSON: ' . json_last_error_msg();
        }
    } else {
        // Tampilkan pesan kesalahan jika file tidak ditemukan
        echo 'File not found: ' . $filename;
    }
    ?>

    <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>