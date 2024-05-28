<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cryptotracker Main</title>
  <link rel="icon" type="image/png" href="../image/cryptotracker.png">
  <link href="../css/cryptofont/cryptofont.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <div>

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
              <a class="nav-link" href="topnews.php"><i class="fas fa-newspaper"></i> Top News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"><i class="fas fa-chart-line"></i> Main</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Body -->
    <div class="container">
      <h3 class="my-4 text-center">Data Koin Cryptocurrency</h3>
      <button id="monitorBtn" class="btn btn-primary mb-3">Monitor</button>
      <select id="listingType">
        <option value="latest">Latest</option>
        <option value="historical">Historical</option>
      </select>
      <div class="d-flex justify-content-center align-items-center">
        <table id="coinTable" class="table table-striped table-bordered text-center">
          <thead>
            <tr>
              <th>Rank</th>
              <th>Symbol</th>
              <th>Price (IDR)</th>
              <th>Volume (IDR)</th>
              <th>Chart</th>
              <th>Monitor</th>
              <th>News</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div id="widgetContainer" class="d-flex justify-content-center align-items-center mt-3"></div>

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
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script src="../js/cryptoapi.js"></script>
</body>

</html>