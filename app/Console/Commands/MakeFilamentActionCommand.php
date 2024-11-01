<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function Laravel\Prompts\info;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;
use function Laravel\Prompts\warning;

class MakeFilamentActionCommand extends Command
{
    protected $signature = 'make:filament-action {name?}
                            {--form : Generate a form component action}
                            {--table : Generate a table component action}
                            {--table-bulk : Generate a table bulk action}
                            {--custom-component : Generate a custom component action}
                            {--infolist : Generate an infolist component action}
                            {--notification : Generate a notification action}
                            {--global-search : Generate a global search result action}';

    protected $description = 'Create a new Filament action class';

    /**
     * @var array<string, string>
     */
    protected array $actionTypes = [
        'form' => 'Filament\\Forms\\Components\\Actions\\Action',
        'table' => 'Filament\\Tables\\Actions\\Action',
        'table-bulk' => 'Filament\\Tables\\Actions\\BulkAction',
        'custom-component' => 'Filament\\Actions\\Action',
        'infolist' => 'Filament\\Infolists\\Components\\Actions\\Action',
        'notification' => 'Filament\\Notifications\\Actions\\Action',
        'global-search' => 'Filament\\GlobalSearch\\Actions\\Action',
    ];

    public function handle(): void
    {
        $name = $this->getNameArgument();
        $className = $this->getClassName($name);
        $type = $this->getActionType();
        $actionClass = $this->actionTypes[$type];
        $baseClass = $type === 'table-bulk' ? 'BulkAction' : 'Action';
        $path = $this->getFilePath($className, $type);

        if ($this->fileExists($path)) {
            warning("$className already exists.");

            return;
        }

        $stubContent = $this->getStubContent();
        $this->generateActionFile($path, $className, $actionClass, $stubContent, $baseClass);

        info("$className created successfully at:");
        info($path);
    }

    private function getNameArgument(): string
    {
        return $this->argument('name') ?? text(
            label: 'Enter the name of the Filament Action',
            required: 'Action name is required.',
        );
    }

    private function getClassName(string $name): string
    {
        return Str::endsWith(Str::lower($name), 'action')
            ? Str::studly($name)
            : Str::studly($name).'Action';
    }

    private function getActionType(): string
    {
        $selectedTypes = array_filter([
            'form' => $this->option('form'),
            'table' => $this->option('table'),
            'table-bulk' => $this->option('table-bulk'),
            'custom-component' => $this->option('custom-component'),
            'infolist' => $this->option('infolist'),
            'notification' => $this->option('notification'),
            'global-search' => $this->option('global-search'),
        ]);

        if (count($selectedTypes) > 1) {
            warning('Please specify only one action type.');

            exit;
        }

        if (count($selectedTypes) === 0) {
            $selectedType = select(
                label: 'Please select the type of the Filament Action',
                options: [
                    'form' => 'Form',
                    'table' => 'Table',
                    'table-bulk' => 'TableBulk',
                    'infolist' => 'Infolist',
                    'notification' => 'Notification',
                    'global-search' => 'GlobalSearch',
                    'custom-component' => 'Custom',
                ]
            );

            return (string) $selectedType;
        }

        return (string) key($selectedTypes);
    }

    private function getFilePath(string $className, string $type): string
    {
        $subDirectory = match ($type) {
            'form' => 'Forms',
            'table', 'table-bulk' => 'Tables',
            'infolist' => 'Infolists',
            'notification' => 'Notifications',
            'global-search' => 'GlobalSearch',
            'custom-component' => 'Custom',
            default => '',
        };

        return app_path("Filament/Actions/$subDirectory/$className.php");
    }

    private function fileExists(string $path): bool
    {
        return File::exists($path);
    }

    private function getStubContent(): string
    {
        $stubPath = app_path('Filament/Actions/Stubs/FilamentAction.stub');

        return File::get($stubPath);
    }

    private function generateActionFile(string $path, string $className, string $actionClass, string $stubContent, string $baseClass): void
    {
        $namespace = $this->getNamespace($path);
        $defaultName = Str::camel(Str::replaceLast('Action', '', $className));

        $content = str_replace(
            ['{{ namespace }}', '{{ className }}', '{{ defaultName }}', '{{ actionClass }}', '{{ baseClass }}'],
            [$namespace, $className, $defaultName, $actionClass, $baseClass],
            $stubContent
        );

        File::ensureDirectoryExists(dirname($path));
        File::put($path, $content);
    }

    private function getNamespace(string $path): string
    {
        $relativePath = Str::after($path, app_path().'/');

        return 'App\\'.Str::replace('/', '\\', dirname($relativePath));
    }
}
