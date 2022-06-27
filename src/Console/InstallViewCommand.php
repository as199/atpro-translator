<?php

namespace Atpro\Translator\Console;


use Atpro\Translator\Models\AtproTranslate;
use Atpro\Translator\services\AtproTranslateViewService;
use Illuminate\Console\Command;

class InstallViewCommand extends Command
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
     */
    public function handle(): void
    {
        $input['to'] = $this->ask('Yours languages seperated with commas (,) example: fr,es ... ?');
        $to = explode(',',$input['to']);
        $atproTranslate = new AtproTranslate();
        $this->info('Loading ...');
        foreach ($to as $item) {
            $atproTranslate->firstOrCreate(['code'=>$item]);
        }
        $atproTranslateViewService = new AtproTranslateViewService();
        $atproTranslateViewService->createView();
        $this->info('Files saved added successfully');
    }
}