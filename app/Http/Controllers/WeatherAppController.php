<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherAppController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getWeather(Request $request, $location="tokyo,jp") {
        $res = ['status'=>false, 'message'=>'Something went wrong', 'data'=>null];
        $resCode = 204;

        $response = Http::get(env("WEATHER_API_URL")."weather", [
            'units' => 'imperial',
            'q' => $location,
            'appid' => env('WEATHER_API_KEY'),
        ]);
        if($response->ok()) {
            $responseData = $response->json();

            $rainInfo = ['time'=> 0, 'volume'=>0];

            if(isset($responseData['rain']) || array_key_exists('rain', $responseData)) {
                $rainInfo['time'] = key($responseData['rain']);
                $rainInfo['volume'] = $responseData['rain'][$rainInfo['time']];
            }
            $res['status'] = true;
            $res['message'] = 'Got Data';
            $res['data'] = [
                'lat' => $responseData['coord']['lat'],
                'lon' => $responseData['coord']['lon'],
                'title' => $responseData['name'].", ".$responseData['sys']['country'],
                'temp' => round($responseData['main']['temp'], 0),
                'temp_desc' => ucwords($responseData['weather'][0]['description']),
                'temp_high' => $responseData['main']['temp_max'],
                'temp_low' => $responseData['main']['temp_min'],
                'wind' => $responseData['wind']['speed'],
                'rain' => $rainInfo,
                'sunrise' => $responseData['sys']['sunrise'],
                'sunset' => $responseData['sys']['sunset'],
                'icon' => str_replace('_',$responseData['weather'][0]['icon'],env('WEATHER_API_ICON'))
            ];
            $resCode = 200;
        }
        return response()->json($res, $resCode);
    }
    public function getHourlyWeather(Request $request, $datetime, $lat, $lon) {
        $res = ['status'=>false, 'message'=>'Something went wrong', 'data'=>null];
        $resCode = 204;

        $datetime = strtotime($datetime);
        $response = Http::get(env("WEATHER_API_URL")."onecall", [
            'units' => 'imperial',
            'lat' => $lat,
            'lon' => $lon,
            'exclude' => "current,minutely,alerts,daily",
            'appid' => env('WEATHER_API_KEY'),
        ]);
        if($response->ok()) {
            $responseData = $response->json();
            $availaHourlyData = [];
            foreach($responseData['hourly'] as $aHourly) {
                $hourDiff = abs($aHourly['dt'] - $datetime)/(60*60);
                $data7 = [];
                if($hourDiff <= 3) {
                    $data7['datetime'] = date("Y-m-d H:i:s", $aHourly['dt']);
                    $data7['icon'] = str_replace('_',$aHourly['weather'][0]['icon'],env('WEATHER_API_ICON'));
                    $data7['temp'] = $aHourly['temp'];
                    $data7['is_now'] = false;
                    if($hourDiff == 0) {
                        $data7['is_now'] = true;
                    }
                    $availaHourlyData[] = $data7;
                }
            }
            $res['status'] = true;
            $res['message'] = 'Got Data';
            $res['data'] = $availaHourlyData;
            $resCode = 200;
        }
        return response()->json($res, $resCode);
    }
    public function getDaysWeather(Request $request, $lat, $lon) {
        $res = ['status'=>false, 'message'=>'Something went wrong', 'data'=>null];
        $resCode = 204;

        $response = Http::get(env("WEATHER_API_URL")."onecall", [
            'units' => 'imperial',
            'lat' => $lat,
            'lon' => $lon,
            'exclude' => "current,minutely,alerts,hourly",
            'appid' => env('WEATHER_API_KEY'),
        ]);
        if($response->ok()) {
            $responseData = $response->json();
            $availaDailyData = [];
            foreach($responseData['daily'] as $aDaily) {
                $data7['day'] = date("D", $aDaily['dt']);
                $data7['date'] = date("d/m", $aDaily['dt']);
                $data7['icon'] = str_replace('_',$aDaily['weather'][0]['icon'],env('WEATHER_API_ICON'));
                $data7['temp'] = $aDaily['temp']['day'];
                $data7['low'] = $aDaily['temp']['min'];
                $data7['high'] = $aDaily['temp']['max'];
                $data7['wind'] = $aDaily['wind_speed'];
                $data7['rain'] = 0;

                if(isset($aDaily['rain']) || array_key_exists('rain', $aDaily)) {

                    $data7['rain'] = $aDaily['rain'];
                }

                $availaDailyData[] = $data7;
            }
            unset($availaDailyData[0]);

            $res['status'] = true;
            $res['message'] = 'Got Data';
            $res['data'] = $availaDailyData;
            $resCode = 200;
        }

        return response()->json($res, $resCode);
    }
}
