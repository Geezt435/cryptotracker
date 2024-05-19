$(document).ready(function () {
  const baseUrl = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/';

  const parameters = {
    start: '1',
    limit: '1000',
    convert: 'IDR'
  };

  const headers = {
    Accept: 'application/json',
    'X-CMC_PRO_API_KEY': 'f09f5424-8c7b-44e1-823d-9790a031c8ae'
  };

  // Function to fetch data
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

        // If listingType is 'historical', adjust the structure (DEPRECATED)
        // if (listingType === 'historical') {}

        coinTable = $('#coinTable').DataTable({
          data: data.data,
          columns: [
            { data: 'cmc_rank' },
            { data: 'symbol' },
            {
              data: null,
              render: function (data, type, row) {
                return '<img src="https://api.coingecko.com/api/v3/coins/' + row.symbol + '" height="20" width="20">' + data.symbol;
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
            // {
            //   data: 'quote.IDR.percent_change_1h',
            //   render: function (data, type, row) {
            //     return parseFloat(data).toFixed(2) + "%";
            //   }
            // },
            // {
            //   data: 'quote.IDR.percent_change_24h',
            //   render: function (data, type, row) {
            //     return parseFloat(data).toFixed(2) + "%";
            //   }
            // },
            // {
            //   data: 'quote.IDR.percent_change_7d',
            //   render: function (data, type, row) {
            //     return parseFloat(data).toFixed(2) + "%";
            //   }
            // },
            {
              data: null,
              render: function (data, type, row) {
                  return `
                      <div class="p-5 m-2 tradingview-widget-container">
                          <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js">
                          {
                              "symbol": "BINANCE:${row.symbol}",
                              "width": "100%",
                              "height": "100%",
                              "locale": "en",
                              "dateRange": "12M",
                              "colorTheme": "light",
                              "isTransparent": true,
                              "autosize": true,
                              "largeChartUrl": "",
                              "chartOnly": true
                          }
                          </script>
                      </div>`;
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
            }],
          order: [[0, 'asc']],
          retrieve: true,
          paging: false,
          destroy: true,
          pageLength: 50
        });
      })
      .catch(error => {
        console.error('Terjadi kesalahan: ', error);
      });
  }
  
  $('#coinTable').on('draw.dt', function() {
    $('div.tradingview-widget-container__widget').each(function() {
        const symbol = this.id;
        new TradingView.MiniWidget({
            "container_id": symbol,
            "symbol": "BINANCE:" + symbol,
            "width": "100%",
            "height": "100%",
            "locale": "en",
            "dateRange": "12M",
            "colorTheme": "light",
            "isTransparent": true,
            "autosize": true,
            "largeChartUrl": "",
            "chartOnly": true
        });
    });
});

  // Fetch data when the page loads (default: latest)
  fetchData('latest');

  // Fetch data when the selection changes and modify the table structure
  $('#listingType').change(function () {
    const listingType = $(this).val();

    // tambah dan hapus kolom (DEPRECATED)
    // if (listingType === 'historical') {
    //   $('#coinTable thead tr th').eq(0).before('<th>ID</th>'); // Insert 'ID' at the first position
    //   $('#coinTable thead tr th').eq(2).before('<th>Slug</th>'); // Insert 'Slug' at the third position
    // } else {
    //   $('#coinTable thead tr th:contains("ID")').remove();
    //   $('#coinTable thead tr th:contains("Slug")').remove();
    // }

    // REFRESH
    coinTable.destroy();

    fetchData(listingType);
  });

  // Untuk monitoring (tombol monitor)
  $('#monitorBtn').on('click', function () {
    const selectedSymbols = [];
    $('#coinTable tbody input[type="checkbox"]:checked').each(function () {
      selectedSymbols.push($(this).val());
    });
    const symbolsQuery = selectedSymbols.join(',');

    // Check monitor kosong atau tidak
    if (!symbolsQuery || symbolsQuery.trim() === "") {
      $('#warningModal').modal('show');
    } else {
      const monitorUrl = `monitor.php?coin=${symbolsQuery}`;
      window.open(monitorUrl, '_blank');
    }
  });

  $('#topnewsBtn').on('click', function () {
    const monitorUrl = `topnews.php`;
    window.open(monitorUrl, '_blank');
  });

  // add a click event listener to a button within a table, retrieves the data of the row containing the clicked button, 
  // and logs that data to the console.
  $('#coinTable tbody').on('click', 'button', function () {
    var data = coinTable.row($(this).parents('tr')).data();
    console.log(data);
  });
});