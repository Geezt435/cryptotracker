const axios = require('axios');

const options = {
  method: 'GET',
  url: 'https://cryptofonts-token-icon-api1.p.rapidapi.com/1/0x7d1afa7b718fb893db30a3abc0cfc608aacfebb0',
  headers: {
    'X-RapidAPI-Key': '3b883dceb5msh6e7a3715d5c8efdp188dd1jsn4e277ce5e234',
    'X-RapidAPI-Host': 'cryptofonts-token-icon-api1.p.rapidapi.com'
  }
};

try {
	const response = await axios.request(options);
	console.log(response.data);
} catch (error) {
	console.error(error);
}