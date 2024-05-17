<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cryptotracker</title>
  <link rel="icon" type="image/png" href="../image/cryptotracker.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <h1 class="my-4 text-center">Cryptotracker</h1>
    <h3 class="my-4 text-center">Data Koin Cryptocurrency</h3>
    <button id="monitorBtn" class="btn btn-primary mb-3">Monitor</button>
    <button onclick="window.location.href='topnews.php'" target="_blank" class="btn btn-success mb-3">Top News</button>
    <div class="d-flex justify-content-center align-items-center">
      <table id="coinTable" class="table table-striped table-bordered text-center">
        <thead>
          <tr>
            <th>Rank</th>
            <th>Name</th>
            <th>Symbol</th>
            <th>Price (IDR)</th>
            <th>Volume (IDR)</th>
            <th>1h (%)</th>
            <th>1d (%)</th>
            <th>1w (%)</th>
            <th>Monitor</th>
            <th>News</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <div id="widgetContainer" class="d-flex justify-content-center align-items-center mt-3"></div>

    <!-- Bootstrap Modal -->
    <!-- Warning Modal -->
    <div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="warningModalLabel">Warning</h5>
          </div>
          <div class="modal-body">
            Monitor requires at least one coin to be selected.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/cryptoapi.js"></script>
</body>
</html>