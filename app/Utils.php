<?php

namespace App;

use Carbon\Carbon;
use App\Consts;
use Auth;
use DB;
use App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class Utils
{

    public static function previous24hInMillis() {
        return Carbon::now()->subDay()->timestamp * 1000;
    }

    public static function previousDayInMillis($day) {
        return Carbon::now()->subDay($day)->timestamp * 1000;
    }

    public static function currentMilliseconds() {
        return round(microtime(true) * 1000);
    }

    public static function toMilliseconds($hours) {
        return floatval($hours) * 60 * 60 * 1000;
    }

    public static function millisecondsToDateTime($timestamp, $timezoneOffsetInMins, $format) {
        return Utils::millisecondsToCarbon($timestamp, $timezoneOffsetInMins)->format($format);
    }

    public static function millisecondsToCarbon($timestamp, $timezoneOffsetInMins) {
        return Carbon::createFromTimestampUTC(floor($timestamp/1000))->subMinutes($timezoneOffsetInMins);
    }

    public static function dateTimeToMilliseconds($stringDate) {
        $date = !empty($stringDate) ? Carbon::parse($stringDate) : Carbon::now();
        return $date->timestamp * 1000 + $date->micro;
    }

    public static function generateRandomString($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];
        $max = strlen($keyspace) - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    public static function trimFloatNumber($val) {
        return strpos($val,'.')!==false ? rtrim(rtrim($val,'0'),'.') : $val;
    }

    public static function saveFileToStorage ($file, $pathFolder, $prefixName = null) {
        $storagePath = 'public' . DIRECTORY_SEPARATOR . $pathFolder;

        $filename = Utils::currentMilliseconds() . '.' . $file->getClientOriginalExtension();
        if (!empty($prefixName)) {
            $filename = $prefixName . '.' .$filename;
        }
        $file->storeAs($storagePath, $filename);
        return "/storage/$pathFolder/$filename";
    }

    public static function getSchemeAndHttpHost()
    {
        return env('APP_URL', 'http://localhost');
    }
}
