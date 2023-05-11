<?php

namespace SarahConnor\Controller;

use SarahConnor\Infrastructure\Integration\WeatherAPIConnection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeatherController extends AbstractController
{
    /**
     * @Route("/weather/{city}", name="get_weather")
     */
    public function getWeather($city): Response
    {
        $weatherAPI = new WeatherAPIConnection();
        $kyivWeather = $weatherAPI->getWeatherInKyiv();

        return new Response(
            '<html><body>Weather in '.$city.': '.$kyivWeather.'</body></html>'
        );
    }
}
