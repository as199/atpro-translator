<?php

namespace Atpro\Translator\Console;


use Atpro\Translator\Models\AtproTranslate;
use Atpro\Translator\services\AtproTranslateViewService;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;

class InstallViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected  $signature = 'atpro:generate-view-translate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected  $description = 'This artisan command is used to generate components and view translations.';

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
        $this->info('Loading please wait ...');
        foreach ($to as $item) {
            if((new Filesystem)->exists(base_path('lang/'.$item))){
                $atproTranslate->firstOrCreate(['code'=>$item]);
            }else{
                $this->info('Language '.$item.' not found in lang folder');
            }

        }
        $atproTranslateViewService = new AtproTranslateViewService();
        $atproTranslateViewService->createView();
        $this->info('Files saved added successfully');
    }
}