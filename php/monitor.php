<?php
$koin = explode(",", $_GET['coin']);
$num = count($koin);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr" class="sid-plesk">

<head>
	<title>Cryptotracker Monitor</title>
	<link rel="icon" type="image/png" href="../image/cryptotracker.png">
	<link rel="stylesheet" href="../css/style.css">
	<script type="text/javascript">
		function zoom() {
			document.body.style.zoom = "80%";
		}

		window.onload = function() {
			zoom();

			const koin = <?php echo json_encode($koin); ?>;

			// Create widgets for the left div
			const leftDiv = document.getElementById('left');
			koin.forEach(coin => {
				const widgetContainer = document.createElement('div');
				widgetContainer.className = 'tradingview-widget-container';
				widgetContainer.style.marginBottom = '32px';

				const widget = document.createElement('div');
				widget.className = 'tradingview-widget-container__widget';
				widget.style.height = 'calc(100% - 32px)';
				widget.style.width = '100%';

				const script = document.createElement('script');
				script.type = 'text/javascript';
				script.src = 'https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js';
				script.async = true;
				script.innerHTML = JSON.stringify({
					autosize: true,
					symbol: `BINANCE:${coin}USDT`,
					interval: 'D',
					timezone: 'Asia/Jakarta',
					theme: 'dark',
					style: '1',
					locale: 'id',
					enable_publishing: false,
					allow_symbol_change: true,
					studies: ['STD;RSI', 'STD;Stochastic_RSI'],
					support_host: 'https://www.tradingview.com'
				});

				widgetContainer.appendChild(widget);
				widgetContainer.appendChild(script);
				leftDiv.appendChild(widgetContainer);
			});

			// Create widgets for the right div
			const rightDiv = document.getElementById('right');
			koin.forEach(coin => {
				const right2aDiv = document.createElement('div');
				right2aDiv.id = 'right2a';

				const widgetContainer = document.createElement('div');
				widgetContainer.className = 'tradingview-widget-container';

				const widget = document.createElement('div');
				widget.className = 'tradingview-widget-container__widget';

				const script = document.createElement('script');
				script.type = 'text/javascript';
				script.src = 'https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js';
				script.async = true;
				script.innerHTML = JSON.stringify({
					interval: '1h',
					width: '100%',
					isTransparent: true,
					height: '100%',
					symbol: `BINANCE:${coin}USDT`,
					showIntervalTabs: true,
					displayMode: 'single',
					locale: 'id',
					colorTheme: 'dark'
				});

				widgetContainer.appendChild(widget);
				widgetContainer.appendChild(script);
				right2aDiv.appendChild(widgetContainer);
				rightDiv.appendChild(right2aDiv);
			});
		}
	</script>
</head>

<body>
	<div id="left">
		<!-- Widgets will be dynamically added here by JavaScript -->
	</div>
	<div id="right">
		<!-- Widgets will be dynamically added here by JavaScript -->
	</div>
	<div id="ticker">
		<!-- TradingView Widget BEGIN -->
		<div class="tradingview-widget-container">
			<div class="tradingview-widget-container__widget"></div>
			<div class="tradingview-widget-copyright">
				<a href="https://id.tradingview.com/" rel="noopener nofollow" target="_blank">
					<span class="blue-text" style="visibility:hidden;">Lacak seluruh pasar di TradingView</span>
				</a>
			</div>
			<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
				{
					"symbols": [
						<?php
						$i = 0;
						foreach ($koin as $coin) {
							$i++;
						?> {
								"description": "",
								"proName": "<?php echo $coin . "USDT"; ?>"
							}
						<?php
							if ($i != $num)
								echo ",";
						}
						?>
					],
					"showSymbolLogo": true,
					"isTransparent": false,
					"displayMode": "adaptive",
					"colorTheme": "dark",
					"locale": "id"
				}
			</script>
		</div>
		<!-- TradingView Widget END -->
	</div>
</body>

</html>