<?php

namespace Atpro\Translator\Console;

use Atpro\Translator\services\AtproTranlatorViewService;
use Atpro\Translator\services\AtproTranslateService;
use ErrorException;
use Illuminate\Console\Command;

class ViewTranslatorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atpro:generate-view-translate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This artisan command is used to add user data without registering.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws ErrorException
     */
    public function handle(): void
    {
        $input['to'] = $this->ask('Yours languages seperated with commas (,) example: fr,es ... ?');
        $to = explode(',',$input['to']);
        $atproTranslateViewService = new AtproTranlatorViewService();
        $this->info('Loading ...');
        $atproTranslateViewService->saveLanguages($to);
        $this->info('Files saved added successfully');

    }
}
