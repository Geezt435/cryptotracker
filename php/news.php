<?php
// ngacek parameter symbol aya weh, mun aya dipake mun eweh jadi string kosongan
$symbol = isset($_GET['symbol']) ? $_GET['symbol'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/cryptofont/nav.css" rel="stylesheet">
    <link href="../css/cryptofont/cryptofont.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="../image/cryptotracker.png">
    <title>News - <?php echo htmlspecialchars($symbol); ?></title>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../image/cryptotracker.png" alt="Cryptotracker" width="30" height="30">
                Cryptotracker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="portofolios.php"><i class="fas fa-newspaper"></i> Portofolios</a>
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

    <div class="container">
        <h3 class="my-4">News for <?php echo htmlspecialchars(strtoupper($symbol)); ?></h3>
        <div id="news-container" class="list-group"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // nyokot symbol jadi objek
        var symbol = '<?php echo htmlspecialchars($symbol); ?>';

        // pungsi jang nyokot data api
        async function fetchNews(symbol) {
            var apiUrl = `https://newsdata.io/api/1/news?apikey=pub_4560931b6136dfb212bcf743fec2c0c889b8e&q=${symbol}&language=en`;
            //nyobaan ngajalanken proses nyokot data ti api mun respon ok pungsi displayNews di hajar, mun hante catch nu jalan

            try {
                let response = await fetch(apiUrl);
                let newsData = await response.json();
                displayNews(newsData);
            } catch (error) {
                console.error('Error fetching news:', error);
                document.getElementById('news-container').innerHTML = '<p>Error fetching news.</p>';
            }
        }

        // Fungsi untuk menampilkan berita
        function displayNews(newsData) { //nyien pungsi anyar ngaranan displaynews
            var container = document.getElementById('news-container'); //nyien id news-container meh bisa nga get id numake
            if (newsData && newsData.results && newsData.results.length > 0) { // lamun si panjang karakterna lewih ti 0 atawa te kosong ngaeksekusi 
                newsData.results.forEach(function(news) { // perulangan jalan lamun if bener
                    var newsItem = document.createElement('a'); //nyien elemen anyar ngarana a
                    newsItem.href = news.link; //nyien href anyar ngarana news meh diarahken ka link beritana
                    newsItem.className = 'list-group-item list-group-item-action'; //nyien class anyar
                    newsItem.target = '_blank'; // nyien target anyar jang ngarahken konten nu di pencet di tab anyar
                    newsItem.innerHTML = ` 
                        <h5 class="mb-1">${news.title}</h5>
                        <p class="mb-1">${news.description}</p>
                        <small>${news.pubDate}</small>
                    `; // eusi konten halaman nu di generate
                    container.appendChild(newsItem); // ngasupken eusi newsitem ka container
                });
            } else {
                container.innerHTML = '<p>No news found for ' + symbol.toUpperCase() + '.</p>'; //kondisi mun if te jalan
            }
        }

        // ngageroan pungsi fetchnews
        fetchNews(symbol);
    </script>
</body>

</html>