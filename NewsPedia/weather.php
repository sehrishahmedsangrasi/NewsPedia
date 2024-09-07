<?php
// Your OpenWeatherMap API key
$apiKey = "d544d807edec339d4e4eac4e2be9004f";

// City IDs for multiple cities
$cityIds = [
    "524901",    // Moscow, Russia
    "5128581",   // New York, USA
    "2643743",   // London, UK
    "1850147",   // Tokyo, Japan
    "1172451",   // Karachi, Pakistan
    "1174872",   // Lahore, Pakistan
    "1177662",   // Islamabad, Pakistan
    "1275339",   // Mumbai, India
    "1273294",   // Delhi, India
    "1283240",   // Kathmandu, Nepal
    "1835848",   // Seoul, South Korea
    "1880252",   // Singapore
    "1609350",   // Bangkok, Thailand
    "1642911",   // Jakarta, Indonesia
    "1816670",   // Hong Kong
    "1735161",   // Kuala Lumpur, Malaysia
    "1880251"    // Singapore
];

$weatherData = [];

foreach ($cityIds as $cityId) {
    $apiUrl = "http://api.openweathermap.org/data/2.5/forecast?id=$cityId&appid=$apiKey&units=metric";
    $data = file_get_contents($apiUrl);
    $weatherArray = json_decode($data, true);
    
    if ($weatherArray['cod'] == 200) {
        $cityName = $weatherArray['city']['name'];
        $forecastData = [];
        $counter = 0;
        $days = [];
        
        foreach ($weatherArray['list'] as $forecast) {
            $timestamp = $forecast['dt'];
            $date = date("Y-m-d", $timestamp);
            
            if (!in_array($date, $days)) {
                $days[] = $date;
                
                if (count($days) > 3) break;
                
                $dayName = date("F j, l", $timestamp);
                $condition = $forecast['weather'][0]['main'];
                $icon = $forecast['weather'][0]['icon'];
                $temp = $forecast['main']['temp'];
                
                $forecastData[] = [
                    'date' => $dayName,
                    'condition' => $condition,
                    'icon' => $icon,
                    'temp' => $temp
                ];
            }
        }
        
        $weatherData[] = [
            'city' => $cityName,
            'forecast' => $forecastData
        ];
    }
}
?>


    <style>
        .weather {
            font-family: Arial, sans-serif;
            margin-top: 90px;
        }
        .weather-head h3 {
            text-align: center;
        }
        .weather-forecast {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .forecast {
            border: 1px solid #ccc;
            padding: 4px;
            border-radius: 3px;
            text-align: center;
            margin: 10px;
            width: 22%;
        }
        .icon img {
            font-size: 2rem;
            width: 38px;
            height: 38px;
        }
        .temp {
            font-size: 1.5rem;
        }
        .day {
            margin-top: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="weather">
        <div class="weather-head"><h3>Weather in <span id="city-name"></span></h3></div>
        <div class="weather-forecast" id="weather-forecast">
            <!-- Weather forecast data will be injected here by JavaScript -->
        </div>
    </div>

    <script>
        const weatherData = <?php echo json_encode($weatherData); ?>;
        let currentIndex = 0;

        function updateWeather() {
            const cityData = weatherData[currentIndex];
            document.getElementById('city-name').innerText = cityData.city;
            const forecastContainer = document.getElementById('weather-forecast');
            forecastContainer.innerHTML = '';

            cityData.forecast.forEach((forecast, index) => {
                const classNames = ['first', 'second', 'third'];
                const forecastDiv = document.createElement('div');
                forecastDiv.className = `forecast ${classNames[index]}`;
                forecastDiv.innerHTML = `
                    <div class="condition"><span>${forecast.condition}</span></div>
                    <div class="icon"><img src="http://openweathermap.org/img/wn/${forecast.icon}@2x.png" alt=""></div>
                    <div class="temp"><span>${forecast.temp}°C</span></div>
                    <div class="day"><span>${forecast.date}</span></div>
                `;
                forecastContainer.appendChild(forecastDiv);
            });

            currentIndex = (currentIndex + 1) % weatherData.length;
        }

        updateWeather();
        setInterval(updateWeather, 10000);
    </script>
</body>
</html>
