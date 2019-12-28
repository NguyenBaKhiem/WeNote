<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Consts;
use DB;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::enableQueryLog();
        DB::listen(function ($query) {
            $ignoreKyes = ['insert into `jobs`', 'select * from `jobs`'];
            foreach ($ignoreKyes as $key) {
                if (substr($query->sql, 0, strlen($key)) === $key) {
                    return;
                }
            }

            Log::debug('SQL', [
                'sql' => $query->sql,
                'bindings' => $query->bindings,
                'runtime' => $query->time
            ]);
        });
    }
}
