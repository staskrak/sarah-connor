<?php

namespace SarahConnor\Infrastructure\Integration;

/**
 * This class represents a connection to a weather API and can retrieve the weather in Kyiv.
 */
class WeatherAPIConnection {

    /**
     * This method retrieves the weather in Kyiv from the API.
     *
     * @return string The current weather in Kyiv
     */
    public function getWeatherInKyiv() {
        try {
            // Simulate connection to weather API
            $weatherData = file_get_contents('https://api.weather.com/kyiv?apiKey=171cb4d40b1acdb9b56899f77fae29e6');

            // Parse the weather data and extract the current weather
            $weather = json_decode($weatherData, true)['current']['weather'];

            // Return the current weather
            return $weather;
        } catch (\Exception $e) {
            // Log the error
            error_log("Error retrieving weather data: " . $e->getMessage());

            // Return an error message
            return "Error retrieving weather data";
        }
    }
}