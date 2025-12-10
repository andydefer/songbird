<?php

namespace AndyDefer\Songbird;

use AndyKani\Songbird\SongbirdManager;
use Illuminate\Support\ServiceProvider;

class SongbirdServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publier tout en une seule commande artisan
        $this->publishes([
            __DIR__ . '/../config/songbird.php' => config_path('songbird.php'),
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
            __DIR__ . '/../routes/' => base_path('routes/songbird'),
            __DIR__ . '/../tests/' => base_path('tests/Packages/Songbird'),
        ], 'songbird');

        // Charger automatiquement les routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Charger automatiquement les migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Charger les vues si nécessaire
        // $this->loadViewsFrom(__DIR__ . '/../resources/views', 'songbird');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Fusionner la configuration avec celle de l'application
        $this->mergeConfigFrom(
            __DIR__ . '/../config/songbird.php',
            'songbird'
        );

        // Enregistrer le singleton pour la façade
        $this->app->singleton('songbird', function ($app) {
            return new SongbirdManager();
        });
    }
}
