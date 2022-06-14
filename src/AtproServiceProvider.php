<?php

namespace Atpro\Translator;

use Atpro\Translator\App\View\Components\CurrentLanguage;
use Atpro\Translator\services\AtproTranslateService;
use Atpro\Translator\App\View\Components\Current;
use Atpro\Translator\App\View\Components\Language;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AtproServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'atpro');
        if (!$this->app->runningInConsole()) {
            return;
        }
        $this->loadViewComponentsAs('flag', [Current::class, Language::class, CurrentLanguage::class]);
        $this->commands([
            Console\InstallCommand::class,
            Console\ViewTranslatorCommand::class,
        ]);


    }

    public function register()
    {

    }



}
