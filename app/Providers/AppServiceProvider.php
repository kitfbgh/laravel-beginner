<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        DB::listen(function ($query) {
            $sql = $query->sql;

            if (!preg_match('/^select|^update|^delete/', $sql)) {
                return;
            }

            $bindings = array_map(function ($parameter) {
                return is_string($parameter) || strtotime($parameter) !== false ? "'$parameter'" : $parameter;
            }, $query->bindings);

            $queryString = sprintf(preg_replace('/\?/', '%s', $sql), ...$bindings);
            $connectionName = $query->connectionName;

            Log::channel('sql-tuning')->info($connectionName);
            Log::channel('sql-tuning')->info($sql);
            Log::channel('sql-tuning')->info($queryString);
        });

    }
}


