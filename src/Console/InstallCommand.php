<?php

namespace Atpro\Translator\Console;

use Atpro\Translator\services\AtproTranslateService;
use ErrorException;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected  $signature = 'atpro:translate {--e=} {--f=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected  $description = 'This artisan command is used to translate lang in laravel.';

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
        $input['from'] = $this->ask('Your started language ?');
        $input['to'] = $this->ask('Yours translated list language seperated with commas (,) example: fr,es ... ?');
        $to = explode(',',$input['to']);
        $except = $this->option('e') !== null ? explode(',',$this->option('e')) : [];
        $files = $this->option('f') !== null ? explode(',',$this->option('f')) : [];
        $atproTranslateService = new AtproTranslateService();
        $this->info('Loading ...');
        if (!empty($files) and !empty($except)) {
            $this->error('Cant not combine files (--f) and except (--e) .');
        }else{
            if (!empty($except)){
                $atproTranslateService->translateExept($input['from'],$to, $files);
            }
            else if (!empty($files)){
                $atproTranslateService->translateList($input['from'],$to, $files);
            }else{
                $atproTranslateService->translate($input['from'],$to);
            }
            $this->info('Files translated added successfully');
            $atproTranslateService->deleteDirectory();
        }

    }
}
