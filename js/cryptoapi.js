$(document).ready(function () {
  const baseUrl = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/';
  const parameters = { start: '1', limit: '1000', convert: 'IDR' };
  const headers = {
    Accept: 'application/json',
    'X-CMC_PRO_API_KEY': 'f09f5424-8c7b-44e1-823d-9790a031c8ae'
  };

  function fetchData(listingType) {
    const qs = new URLSearchParams(parameters).toString();
    const requestUrl = `${baseUrl}${listingType}?${qs}`;

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
          {
            data: null,
            render: function (data, type, row) {
              return '<i class="cf cf-' + row.symbol.toLowerCase() + '"></i> ' + data.symbol;
            }
          },
          {
            data: 'quote.IDR.price',
            render: function (data, type, row) {
              return parseFloat(data).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            }
          },
          {
            data: 'quote.IDR.volume_24h',
            render: function (data, type, row) {
              return parseFloat(data).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            }
          },
          {
            data: null,
            render: function (data, type, row) {
              return `<div class="tradingview-widget-container" id="chart_${row.symbol}"></div>`;
            }
          },
          {
            data: null,
            render: function (data, type, row) {
              return '<input type="checkbox" name="' + row.symbol + '" value="' + row.symbol + '">';
            }
          },
          {
            data: null,
            render: function (data, type, row) {
              return '<button onclick="window.open(\'https://www.tradingview.com/symbols/' + row.symbol + '/news/\', \'_blank\')" class="btn btn-primary">News</button>';
            }
          }
        ],
        order: [[0, 'asc']],
        retrieve: true,
        destroy: true,
        pageLength: 10
      });

      // Initialize the charts after the table is drawn, only once
      initializeCharts(data.data);
    })
    .catch(error => {
      console.error('Terjadi kesalahan: ', error);
    });
  }

  function initializeCharts(data) {
    data.forEach(row => {
      const symbol = row.symbol;
      const script = document.createElement('script');
      script.type = 'text/javascript';
      script.src = 'https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js';
      script.innerHTML = `{
      "symbol": "${row.symbol}",
      "width": "150",
      "height": "100",
      "locale": "en",
      "dateRange": "1M",
      "colorTheme": "light",
      "isTransparent": true,
      "autosize": false,
      "largeChartUrl": "",
      "chartOnly": true,
      "noTimeScale": true
      }`;
      document.getElementById(`chart_${symbol}`).appendChild(script);
    });
  }

  // Initial fetch data
  fetchData('latest');

  // Monitor button visibility
  $('#listingType').change(function () {
    const listingType = $(this).val();
    $('#coinTable').DataTable().destroy();
    fetchData(listingType);
  });

  // Monitor button click event
  $('#monitorBtn').on('click', function () {
    const selectedSymbols = [];
    $('#coinTable tbody input[type="checkbox"]:checked').each(function () {
      selectedSymbols.push($(this).val());
    });
    const symbolsQuery = selectedSymbols.join(',');

    if (!symbolsQuery || symbolsQuery.trim() === "") {
      $('#warningModal').modal('show');
    } else {
      const monitorUrl = `monitor.php?coin=${symbolsQuery}`;
      window.open(monitorUrl, '_blank');
    }
  });

  // Cointable button click event
  $('#coinTable tbody').on('click', 'button', function () {
    const data = $('#coinTable').DataTable().row($(this).parents('tr')).data();
    console.log(data);
  });
});
