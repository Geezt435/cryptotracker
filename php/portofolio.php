<!DOCTYPE html>
<html>
<?php
// news.php

// ambil simbol berdasarkan url 
$symbol = isset($_GET['symbol']) ? $_GET['symbol'] : '';

// mengambil data dari api berdasarkan variabel simbol 
$apiUrl = "https://pro-api.coinmarketcap.com/v2/cryptocurrency/info?CMC_PRO_API_KEY=f09f5424-8c7b-44e1-823d-9790a031c8ae&symbol={$symbol}";

// // menginisialisasikan sesi curl
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $apiUrl);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// // mengekeskusi/jalankan sesi curl 
// $response = curl_exec($ch);
// $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// // menampilkan data berita jika berhasil jika tidak null
// if ($httpCode === 200) {
//     $data = json_decode($response, true);
// } else {
//     $data = null;
// }

// curl_close($ch);

// Make the API request
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);
echo $apiUrl;
?>

<head>
    <link href="../css/cryptofont/nav.css" rel="stylesheet">
    <link href="../css/cryptofont/cryptofont.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="../image/cryptotracker.png">
    <title>Portofolio - <?php echo htmlspecialchars($symbol); ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <a class="nav-link" href="topnews.php"><i class="fas fa-newspaper"></i> Top News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><i class="fas fa-chart-line"></i>
                            Main</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <h3 class="my-4">Portofolio for <?php echo htmlspecialchars(strtoupper($symbol)); ?></h3>
        <?php if ($data && !empty($data['results'])): ?>
            <div class="list-group">
                <?php foreach ($data['results'] as $news): ?>
                    <a href="<?php echo htmlspecialchars($news['link']); ?>" class="list-group-item list-group-item-action"
                        target="_blank">
                        <h5 class="mb-1"><?php echo htmlspecialchars($news['title']); ?></h5>
                        <p class="mb-1"><?php echo htmlspecialchars($news['description']); ?></p>
                        <small><?php echo htmlspecialchars($news['pubDate']); ?></small>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No data found for <?php echo htmlspecialchars($symbol); ?>.</p>
        <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>