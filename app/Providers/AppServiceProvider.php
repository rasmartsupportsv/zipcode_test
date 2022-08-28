<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Resources\ZipCodeCollection;

use Illuminate\Support\Facades\Event;
use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Database\Events\MigrationsStarted;
use DB;

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
        Event::listen(MigrationsStarted::class, function (){
                DB::statement('SET SESSION sql_require_primary_key=0');
        });

        Event::listen(MigrationsEnded::class, function (){
                DB::statement('SET SESSION sql_require_primary_key=1');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
          ZipCodeCollection::withoutWrapping();
    }
}
