<?php 
date_default_timezone_set('Europe/Zagreb');
$hora_atual = date('H:i:s');
$date = date('d');
$month = date('M');
$day = date('l');

// Set default city to Zagreb
$city = 'Zagreb';

// Check if a user submitted a different city
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $userCity = isset($_POST["city"]) ? trim($_POST["city"]) : "";

    if (!empty($userCity)){
        $city = $userCity;
    }
}

$api_key = "4e1e0ffe415b4c4eda39117c34dac66b";
$api = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=" . $api_key;
$headers = get_headers($api);

if (!$headers || strpos($headers[0], '404') !== false){
    $errorMessage = 'City not found';
} else {
    $api_data = file_get_contents($api);

    if ($api_data === false){
        $errorMessage = "Error fetching weather data";
    } else {
        $weather = json_decode($api_data, true);
        $celcius = number_format(($weather['main']['temp'] - 273.15), 0);

        switch ($weather['weather'][0]['icon']){
            case "01d":
                $icon = "images/01d.png";
                break;
            case "01n":
                $icon = "images/01n.png";
                break;
            case "02d":
                $icon = "images/02d.png";
                break;
            case "02n":
                $icon = "images/02n.png";
                break;
            case "03d":
                $icon = "images/03d.png";
                break;
            case "03n":
                $icon = "images/03n.png";
                break;
            case "04d":
                $icon = "images/04.png";
                break;
            case "04n":
                $icon = "images/04.png";
                break;
            case "09d":
                $icon = "images/09.png";
                break;
            case "09n":
                $icon = "images/09.png";
                break;
            case "10d":
                $icon = "images/10d.png";
                break;
            case "10n":
                $icon = "images/10n.png";
                break;
            case "11d":
                $icon = "images/11.png";
                break;
            case "11n":
                $icon = "images/11.png";
                break;
            case "13d":
                $icon = "images/13.png";
                break;
            case "13n":
                $icon = "images/13.png";
                break;
            case "50d":
                $icon = "images/50d.png";
                break;
            case "50n":
                $icon = "images/50n.png";
                break;
            default:
                $icon = "images/n-clear-sky.png";
        }

        // Fetch the next seven days forecast
        $seven_day_api = "https://api.openweathermap.org/data/2.5/forecast?q=" . urlencode($city) . "&appid=" . $api_key;
        $seven_day_data = file_get_contents($seven_day_api);

        if ($seven_day_data === false){
            $errorMessage = "Error fetching seven-day forecast data";
        } else {
            $seven_day = json_decode($seven_day_data, true);
            $celcius = number_format(($weather['main']['temp'] - 273.15), 0);
        }
    }
}
?>
