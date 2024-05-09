<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coin Market Data</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1 class="my-4">Data Koin</h1>
    <button id="monitorBtn" class="btn btn-primary mb-3">Monitor</button>
    <table id="coinTable" class="table table-striped table-bordered">
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
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

  <script>
    $(document).ready(function() {
      const url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
      const parameters = {
        start: '1',
        limit: '1000', 
        convert: 'IDR' 
      };

      const headers = {
        Accept: 'application/json',
        'X-CMC_PRO_API_KEY': 'f09f5424-8c7b-44e1-823d-9790a031c8ae'
      };

      const qs = new URLSearchParams(parameters).toString();
      const requestUrl = `${url}?${qs}`;

      fetch(requestUrl, {
        method: 'GET',
        headers: headers
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          const coinTable = $('#coinTable').DataTable({
            data: data.data,
            columns: [
              { data: 'cmc_rank' },
              { data: 'name' },
              { data: 'symbol' },
              { data: 'quote.IDR.price',
                render: function(data, type, row) {
                  return parseFloat(data).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                }
              },
              { data: 'quote.IDR.volume_24h',
                render: function(data, type, row) {
                  return parseFloat(data).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                }
              },
              { data: 'quote.IDR.percent_change_1h', 
                render: function(data, type, row) {
                  return parseFloat(data).toFixed(2) + "%";
                }
              },
              { data: 'quote.IDR.percent_change_24h', 
                render: function(data, type, row) {
                  return parseFloat(data).toFixed(2) + "%";
                } 
              },
              { data: 'quote.IDR.percent_change_7d', 
                render: function(data, type, row) {
                  return parseFloat(data).toFixed(2) + "%";
                }
              },
              {
                data: null,
                render: function(data, type, row) {
                  return '<input type="checkbox" name="' + row.symbol + '" value="' + row.symbol + '">';
                }
              },
              { 
                data: null,
                render: function(data, type, row) {
                  return '<button class="btn btn-primary">Action</button>';
                }
              }
            ],
            order: [[0, 'asc']], 
            paging: true,
            pageLength: 50 
          });
        })
        .catch(error => {
          console.error('Terjadi kesalahan ', error);
        });

      $('#monitorBtn').on('click', function() {
        const selectedSymbols = [];
        $('#coinTable tbody input[type="checkbox"]:checked').each(function() {
          selectedSymbols.push($(this).val());
        });
        const symbolsQuery = selectedSymbols.join(',');
        const monitorUrl = `monitor.php?coin=${symbolsQuery}`;
        window.open(monitorUrl, '_blank');
      });

      $('#coinTable tbody').on('click', 'button', function() {
        var data = coinTable.row($(this).parents('tr')).data();
        console.log(data);
      });
    });
  </script>
</body>
</html>
