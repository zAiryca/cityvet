
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'setlocale' => \App\Http\Middleware\SetLocale::class,
        ]);
    })
    ->withSchedule(function (Schedule $schedule) {
        // Auto-transition impounded pets to adoptable after 3 days
        $schedule->command('pets:transition-impounded-to-adoptable')
            ->daily()->at('12:00')
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/schedule-impound.log'));

        // Auto-transition adoptable pets to unadopted after 4 days
        $schedule->command('pets:transition-adoptable-to-unadopted')
            ->daily()->at('12:30')
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/schedule-adoptable.log'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
