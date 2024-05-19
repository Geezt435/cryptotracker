<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cryptotracker News</title>
    <link rel="icon" type="image/png" href="../image/cryptotracker.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <!-- Page Title -->
        <h1 class="text-center">Top Crypto News</h1>

        <!-- Top Crypto News TradingView Widget -->
        <div class="d-flex justify-content-center align-items-center">
            <div class="tradingview-widget-container">
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js" async>
                        {
                            "feedMode": "all_symbols",
                            "isTransparent": false,
                            "displayMode": "adaptive",
                            "width": "1000",
                            "height": "400",
                            "colorTheme": "light",
                            "locale": "en"
                        }
                    </script>
                </div>
                <!-- TradingView Widget END -->
            </div>
        </div>

        <!-- Crypto News Table  -->
        <div class="d-flex justify-content-center align-items-center">
            <table id="cryptoNews" class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/newsdataapi.js"></script>
</body>

</html>