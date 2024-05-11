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

  // https://www.w3schools.com/js/js_ajax_asp.asp Untuk searching
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
      console.error('Terjadi kesalahan: ', error);
    });

    $('#monitorBtn').on('click', function() {
      const selectedSymbols = [];
      $('#coinTable tbody input[type="checkbox"]:checked').each(function() {
        selectedSymbols.push($(this).val());
      });
      const symbolsQuery = selectedSymbols.join(',');
      
      // Check monitor kosong apa nggak
      if (!symbolsQuery || symbolsQuery.trim() === "") {
        $('#warningModal').modal('show');
      } else {
        const monitorUrl = `monitor.php?coin=${symbolsQuery}`;
        window.open(monitorUrl, '_blank');
      }
    });

  $('#coinTable tbody').on('click', 'button', function() {
    var data = coinTable.row($(this).parents('tr')).data();
    console.log(data);
  });
});