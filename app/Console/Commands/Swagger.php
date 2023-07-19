<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OpenApi\Generator;
use Symfony\Component\Console\Command\Command as CommandAlias;

class Swagger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command generate a current swagger api documentation';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $openapi = Generator::scan([config('swagger.sources')]);
        file_put_contents("public/api-documentation/swagger.json", $openapi->toJson());
        $this->info('Api documentation generated successfully!');

        return CommandAlias::SUCCESS;
    }
}
