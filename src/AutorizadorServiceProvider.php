<?php
namespace Inadores\Autorizador;

use Inadores\Autorizador\Http\Middleware\AutorizadorMiddleware;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class AutorizadorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //agregando rutas de api
        Route::middleware('api')->prefix('api')->group(function () {
            $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        });

        //agregando middleware
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('autorizador', AutorizadorMiddleware::class);

        //ejecutar las migraciones
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function register()
    {

    }
}