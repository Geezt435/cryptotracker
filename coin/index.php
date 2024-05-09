<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coin Market Data</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1 class="my-4">Data Koin</h1>
    <button id="monitorBtn" class="btn btn-primary mb-3">Monitor</button>
    <table id="coinTable" class="table table-striped">
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

  <script>
    const url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
    const parameters = {
      start: '1',
      limit: '100',
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
        const coinTable = document.getElementById('coinTable').getElementsByTagName('tbody')[0];
        data.data.forEach((coin, index) => {
          const row = coinTable.insertRow();
          row.insertCell(0).textContent = index + 1;
          row.insertCell(1).textContent = coin.name;
          row.insertCell(2).textContent = coin.symbol;
          row.insertCell(3).textContent = parseFloat(coin.quote.IDR.price).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
          row.insertCell(4).textContent = parseFloat(coin.quote.IDR.volume_24h).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
          row.insertCell(5).textContent = parseFloat(coin.quote.IDR.percent_change_1h).toFixed(2) + "%";
          row.insertCell(6).textContent = parseFloat(coin.quote.IDR.percent_change_24h).toFixed(2) + "%";
          row.insertCell(7).textContent = parseFloat(coin.quote.IDR.percent_change_7d).toFixed(2) + "%";

          const checkboxCell = row.insertCell(8);
          const checkbox = document.createElement('input');
          checkbox.type = 'checkbox';
          checkbox.name = `symbol${index}`;
          checkbox.value = coin.symbol;
          checkboxCell.appendChild(checkbox);

          const actionCell = row.insertCell(9);
          const actionButton = document.createElement('button');
          actionButton.textContent = 'Action';
          actionButton.classList.add('btn', 'btn-primary');
          actionCell.appendChild(actionButton);
        });
      })
      .catch(error => {
        console.error('Terjadi kesalahan ', error);
      });

    document.getElementById('monitorBtn').addEventListener('click', () => {
      const selectedSymbols = Array.from(document.querySelectorAll('input[type="checkbox"]:checked')).map(checkbox => checkbox.value);
      const symbolsQuery = selectedSymbols.join(',');
      const monitorUrl = `monitor.php?coin=${symbolsQuery}`;
      window.open(monitorUrl, '_blank');
    });
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
