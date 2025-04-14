<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('rupiah', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });

        Blade::directive('indoDate', function ($expression) {
            return "<?php
                setlocale(LC_TIME, 'id_ID.utf8');
                echo strftime('%d %B %Y', strtotime($expression));
            ?>";
        });

        Blade::directive('indoDateTime', function ($expression) {
            return "<?php
                setlocale(LC_TIME, 'id_ID.utf8');
                echo strftime('%d %B %Y %H:%M', strtotime($expression));
            ?>";
        });
    }
}
