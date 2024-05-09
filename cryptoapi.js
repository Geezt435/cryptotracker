const API_KEY = 'f09f5424-8c7b-44e1-823d-9790a031c8ae'; 
const baseUrl = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
const symbols = ['btc', 'eth', 'dgb']; 

async function getCoinPrices() {
  const url = ${baseUrl}?symbol=${symbols.join(',')};
  const headers = { 'X-CMC_PRO_API_KEY': API_KEY };

  try {
    const response = await fetch(url, { headers });
    if (!response.ok) {
      throw new Error(Error fetching data: ${response.status});
    }
    const data = await response.json();
    return data.data;
  } catch (error) {
    console.error('Error fetching data:', error);
    return null;
  }
}

async function createTable(data) {
  if (!data) {
    return; 
  }

  const table = document.createElement('table');
  const thead = document.createElement('thead');
  const tbody = document.createElement('tbody');

  const headRow = document.createElement('tr');
  const headSymbol = document.createElement('th');
  headSymbol.textContent = 'Symbol';
  const headPrice = document.createElement('th');
  headPrice.textContent = 'Price (USD)';

  headRow.appendChild(headSymbol);
  headRow.appendChild(headPrice);
  thead.appendChild(headRow);

  for (const symbol in data) {
    const price = data[symbol].quote.USD.price;
    const row = document.createElement('tr');
    const cellSymbol = document.createElement('td');
    cellSymbol.textContent = symbol;
    const cellPrice = document.createElement('td');
    cellPrice.textContent = price;

    row.appendChild(cellSymbol);
    row.appendChild(cellPrice);
    tbody.appendChild(row);
  }

  table.appendChild(thead);
  table.appendChild(tbody);

  document.getElementById('your-table-container').appendChild(table);
}

async function main() {
  const data = await getCoinPrices();
  createTable(data);
}

main();