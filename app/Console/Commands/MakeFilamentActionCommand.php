<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function Laravel\Prompts\info;
use function Laravel\Prompts\text;
use function Laravel\Prompts\warning;

class MakeFilamentActionCommand extends Command
{
    protected $signature = 'make:filament-action {name?}';

    protected $description = 'Create a new Filament action class';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $name = $this->getNameArgument();
        $className = $this->getClassName($name);
        $path = $this->getFilePath($className);

        if ($this->fileExists($path)) {
            warning("$className already exists.");

            return;
        }

        $stubContent = $this->getStubContent();
        $this->generateActionFile($path, $className, $stubContent);

        info("$className created successfully at:");
        info($path);
    }

    private function getNameArgument(): string
    {
        return $this->argument('name') ?? text(
            label: 'Enter the name of the Filament Action',
            placeholder: 'MyActionName',
            required: 'Action name is required.',
            hint: "We will append 'Action' to this name, so no need to include it."
        );
    }

    private function getClassName(string $name): string
    {
        return Str::studly($name).'Action';
    }

    private function getFilePath(string $className): string
    {
        return app_path("Filament/Actions/$className.php");
    }

    private function fileExists(string $path): bool
    {
        return File::exists($path);
    }

    /**
     * @throws FileNotFoundException
     */
    private function getStubContent(): string
    {
        $stubPath = app_path('Filament/Actions/Stubs/FilamentAction.stub');

        return File::get($stubPath);
    }

    private function generateActionFile(string $path, string $className, string $stubContent): void
    {
        $namespace = 'App\\Filament\\Actions';
        $defaultName = Str::snake(Str::replaceLast('Action', '', $className));

        $content = str_replace(
            ['{{ namespace }}', '{{ className }}', '{{ defaultName }}'],
            [$namespace, $className, $defaultName],
            $stubContent
        );

        File::ensureDirectoryExists(app_path('Filament/Actions'));
        File::put($path, $content);
    }
}
