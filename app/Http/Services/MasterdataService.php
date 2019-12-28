<?php

namespace App\Http\Services;

use App\Consts;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Schema;

class MasterdataService
{
    protected static $localData = null;

    public static function getDataVersion()
    {
        if (Cache::has('dataVersion')) {
            return Cache::get('dataVersion');
        }

        self::getAllData();
        return Cache::get('dataVersion');
    }

    public static function getAllData()
    {
        if (self::$localData != null) {
            return self::$localData;
        }

        if (Cache::has('masterdata') && Cache::has('dataVersion')) {
            if (self::$localData == null) {
                self::$localData = Cache::get('masterdata');
            }

            return self::$localData;
        }

        $data = [];

        foreach (Consts::MASTERDATA_TABLES as $table) {
            if (Schema::hasTable($table)) {
                if (Schema::hasColumn($table, 'id')) {
                    $data[$table] = DB::table($table)->orderBy('id', 'asc')->get();
                } else {
                    $data[$table] = DB::table($table)->get();
                }
            }
        }

        Cache::forever('masterdata', $data);
        $dataVersion = sha1(json_encode($data));
        Cache::forever('dataVersion', $dataVersion);
        return $data;
    }

    public static function getOneTable($table)
    {
        $key = 'masterdata_' . $table;
        if (Cache::has($key)) {
            return collect(Cache::get($key));
        }

        $data = [];
        $allData = self::getAllData();
        if (!empty($allData[$table])) {
            $data = $allData[$table];
            Cache::forever($key, $data);
        }

        return collect($data);
    }

    public static function clearCacheOneTable($table)
    {
        static::$localData = null;
        Cache::forget("masterdata_$table");
        Cache::forget('dataVersion');
        Cache::forget('masterdata');
    }
}
