<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cryptotracker News</title>
    <link rel="icon" type="image/png" href="../image/cryptotracker.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .tradingview-widget-container {
            max-width: 100%;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                        <a class="nav-link active" aria-current="page" href="#"><i class="fas fa-newspaper"></i> Top News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-chart-line"></i> Main</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Page Title -->
        <h1 class="text-center mb-4">Top Crypto News</h1>
        <!-- Top Crypto News TradingView Widget -->
        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="tradingview-widget-container">
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js" async>
                    {
                        "feedMode": "all_symbols",
                        "isTransparent": false,
                        "displayMode": "adaptive",
                        "width": "100%",
                        "height": 500,
                        "colorTheme": "light",
                        "locale": "en"
                    }
                </script>
            </div>
        </div>
        <!-- Crypto News Tables -->
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <h3 class="text-center mb-3">Forex</h3>
                <table id="forex-table" class="table table-striped table-bordered text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>Source</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#" target="_blank">USDJPY</a></td>
                            <td>Yen Soars as Traders Brace for Potential Interest Rate Hike by Bank of Japan</td>
                            <td>May 24 - 2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <h3 class="text-center mb-3">Stocks</h3>
                <table id="stocks-table" class="table table-striped table-bordered text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>Source</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#" target="_blank">SPX</a></td>
                            <td>S&P 500 Dips as Nvidia's Meteoric Rise Fails to Offset Broader Market Caution</td>
                            <td>May 24 - 2024</td>
                        </tr>
                        <tr>
                            <td><a href="#" target="_blank">RL</a></td>
                            <td>Ralph Lauren Beats Q4 Estimates, Driven by Strong Demand for Luxury Apparel</td>
                            <td>May 24 - 2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <h3 class="text-center mb-3">Crypto</h3>
                <table id="crypto-table" class="table table-striped table-bordered text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>Source</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#" target="_blank">NVDA</a></td>
                            <td>Nvidia Skyrockets on Blowout AI Revenue, Fueling Investor Frenzy</td>
                            <td>May 24 - 2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        
        <!-- Crypto News Table  -->
        <div class="d-flex justify-content-center align-items-center">
            <table id="cryptoNews" class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Publisher</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/newsdataapi.js"></script>
    <script>
        $(document).ready(function() {
            $('#forex-table').DataTable({
                responsive: true,
                language: {
                    emptyTable: "No data available in table"
                }
            });

            $('#stocks-table').DataTable({
                responsive: true,
                language: {
                    emptyTable: "No data available in table"
                }
            });

            $('#crypto-table').DataTable({
                responsive: true,
                language: {
                    emptyTable: "No data available in table"
                }
            });
        });
    </script>
</body>

</html>