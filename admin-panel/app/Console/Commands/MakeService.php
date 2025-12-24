<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $input = str_replace('\\', '/', $this->argument('name'));

        $segments = explode('/', trim($input, '/'));
        $className = array_pop($segments);

        $namespacePath = implode('\\', $segments);
        $directoryPath = implode('/', $segments);

        $directory = app_path("Services/{$directoryPath}");
        $path = "{$directory}/{$className}.php";

        if (File::exists($path)) {
            $this->error('Service already exists!');
            return Command::FAILURE;
        }

        File::ensureDirectoryExists($directory);

        File::put($path, $this->stub($namespacePath, $className));

        $this->info("Service {$className} created successfully.");
        return Command::SUCCESS;
    }

    protected function stub(string $namespacePath, string $className): string
    {
        $namespace = trim("App\Services\\{$namespacePath}", '\\');

        return <<<PHP
                <?php
                namespace {$namespace};
                class {$className}
                {
                    //
                }
                PHP;
    }
}
