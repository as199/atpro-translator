<?php

namespace Atpro\Translator;


use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class AtporServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }
        //$this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'atpro');
        $this->commands([
            Console\InstallCommand::class,
            Console\InstallViewCommand::class,
        ]);

        $this->publishes($this->clonePublish());
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            Console\InstallCommand::class,
            Console\InstallViewCommand::class,
        ];
    }
    private function clonePublish(): array
    {
        if(! (new Filesystem)->exists(base_path('routes/atpro-translate.php')) ){
            $content = file_get_contents(base_path('routes/web.php'));
            $content .= "\n\n\n\n\n";
            $content .= "require __DIR__.'/atpro-translate.php';";
            file_put_contents(base_path('routes/web.php'), $content);
        }
        return [
            dirname(__DIR__).'/default/App/Http/Controllers/Atpro/' => app_path('Http/Controllers/Atpro'),
            dirname(__DIR__).'/default/App/Http/Middleware/' => app_path('Http/Middleware'),
            __DIR__.'/routes/' => base_path('routes'),
            __DIR__.'/resources/views/components/' => resource_path('views/components')
        ];
    }
}
