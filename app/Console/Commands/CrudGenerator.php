<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {name : table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create basic CRUD operations';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        if (!Schema::hasTable($name)) {
            $this->line('<bg=red>                                                                                 </>');
            $this->line('<bg=red>                 Table not found. Please create migration first.                 </>');
            $this->line('<bg=red>                                                                                 </>');
            return;
        }

        $columns = Schema::getColumnListing($name);
        unset($columns[array_search('id', $columns)]);
        unset($columns[array_search('created_at', $columns)]);
        unset($columns[array_search('updated_at', $columns)]);

        unset($columns[array_search('uuid', $columns)]);
        unset($columns[array_search('createdAt', $columns)]);
        unset($columns[array_search('updatedAt', $columns)]);

        if (isset($columns[array_search('deletedAt', $columns)])) {
            unset($columns[array_search('deletedAt', $columns)]);
        }


        $this->controller($name, $columns);
        $this->model($name);
        $this->request($name);
        $this->list($name, $columns);
        $this->create($name, $columns);
        $this->edit($name, $columns);
        $this->sideMenu($name);

        // // write routes to routes/web.php
        $this->routes($name);

        $this->line('<fg=yellow>CRUD for ' . $name . ' created. Please import controller class in routes/admin_crud_generated.php edit Request file to avoid runtime error.</>');
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function sideMenu($name)
    {
        $menu_template = '<li class="{{ $active==\'' . strtolower(Str::plural($name)) . '\'?\'active\':\'\' }} bold">
    <a class="waves-effect waves-cyan {{ $active==\'' . $name . '\'?\'active \'.$site_settings->where(\'setting_name\', \'theme_color\')->first()->setting_value:\'\' }} " href="{{ route(\'admin.' . strtolower(Str::plural($name)) . '.index\') }}">
        <i class="material-icons">assignment</i>
        <span class="menu-title" data-i18n="">' . ucwords(str_replace('_', ' ', $name)) . '</span>
    </a>
</li>' . "\n\n";

        $fp = fopen(base_path('resources/views/admin/partials/aside_generated.blade.php'), 'a') or die("Unable to open file!");
        fwrite($fp, $menu_template);
        fclose($fp);
        $this->line('<fg=green>Sidemenu created</>');
    }

    protected function routes($name)
    {
        $fp = fopen(base_path('routes/admin_crud_generated.php'), 'a') or die("Unable to open file!");
        fwrite(
            $fp,
            "\n\n// routes for " . Str::plural(strtolower($name)) . "\n" . 'Route::resource("/' . Str::plural(strtolower($name)) . '", ' . ucfirst(Str::of($name)->camel()) . 'Controller::class)->except(\'show\');'
        );
        fclose($fp);

        $this->line('<fg=green>Routes for ' . Str::plural(strtolower($name)) . ' added</>');
    }

    protected function model($name)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}', '{{modelNamePluralLowerCase}}'],
            [ucfirst(Str::of($name)->camel()), strtolower(Str::plural($name)),],
            $this->getStub('Model')
        );

        file_put_contents(app_path("/Models/" . ucfirst(Str::of($name)->camel()) . ".php"), $modelTemplate);
        $this->line('<fg=green>Model generated</>');
    }

    protected function controller($name, $columns)
    {
        $cleaned_name = Str::of($name)->camel();
        $col = '';
        foreach ($columns as $c) {
            $col .= "$" . strtolower(Str::singular($name)) . "->" . $c . " = \$request->" . $c . ";\n\t\t\t";
        }
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNameSingularCamelCase}}',
                '{{columnUpdate}}'
            ],
            [
                ucfirst($cleaned_name),
                strtolower(Str::plural($name)),
                strtolower(Str::singular($name)),
                Str::of($cleaned_name)->camel(),
                $col
            ],
            $this->getStub('Controller')
        );

        if (!file_exists($path = app_path('/Http/Controllers/Admin')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Controllers/Admin/" . ucfirst($cleaned_name) . "Controller.php"), $controllerTemplate);
        $this->line('<fg=green>Controller generated</>');
    }

    protected function request($name)
    {
        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [ucfirst(Str::of($name)->camel())],
            $this->getStub('Request')
        );

        if (!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/Store" . ucfirst(Str::of($name)->camel()) . ".php"), $requestTemplate);
        $this->line('<fg=green>Request generated</>');
    }

    // resource view
    protected function list($name, $columns)
    {
        $newColumns = '';
        $columnValues = '';
        foreach ($columns as $c) {
            $newColumns .= '<th>' . $c . '</th>' . "\n\t\t\t\t\t\t\t\t\t\t\t\t\t";
            $columnValues .= '<td>{{ $' . strtolower($name) . '->' . $c . ' }}</td>' . "\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        }

        $listTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{tableColumns}}',
                '{{tableColumnsValue}}'
            ],
            [
                ucfirst($name),
                strtolower(Str::plural($name)),
                strtolower($name),
                $newColumns,
                $columnValues
            ],
            $this->getStub('List')
        );

        if (!file_exists($path = base_path('resources/views/admin/' . Str::of($name)->camel())))
            mkdir($path, 0777, true);

        file_put_contents(base_path("resources/views/admin/" . Str::of($name)->camel() . "/list.blade.php"), $listTemplate);
        $this->line('<fg=green>List file generated</>');
    }

    protected function create($name, $columns)
    {
        $inputTemplate = '';
        foreach ($columns as $c) {
            $inputTemplate .= '<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="' . $c . '" id="' . $c . '">
                                        <label for="' . ucwords(str_replace('_', ' ', $c)) . '">' . ucwords(str_replace('_', ' ', $c)) . ' *</label>
                                    </div>
                                </div>' . "\n";
        }

        $listTemplate = str_replace(
            [
                '{{inputField}}',
                '{{modelNamePluralLowerCase}}'
            ],
            [
                $inputTemplate,
                $name

            ],
            $this->getStub('Create')
        );

        if (!file_exists($path = base_path('resources/views/admin/' . Str::of($name)->camel())))
            mkdir($path, 0777, true);

        file_put_contents(base_path("resources/views/admin/" . Str::of($name)->camel() . "/create.blade.php"), $listTemplate);
        $this->line('<fg=green>Create file generated</>');
    }

    protected function edit($name, $columns)
    {
        $inputTemplate = '';
        foreach ($columns as $c) {
            $inputTemplate .= "\n" . '<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="' . $c . '" id="' . $c . '" value="{{ $' . strtolower(Str::singular($name)) . '->' . $c . ' }}">
                                        <label for="' . ucwords(str_replace('_', ' ', $c)) . '">' . ucwords(str_replace('_', ' ', $c)) . ' *</label>
                                    </div>
                                </div>' . "\n";
        }

        $listTemplate = str_replace(
            [
                '{{inputField}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
            ],
            [
                $inputTemplate,
                $name,
                strtolower(Str::singular($name))

            ],
            $this->getStub('Edit')
        );

        if (!file_exists($path = base_path('resources/views/admin/' . Str::of($name)->camel())))
            mkdir($path, 0777, true);

        file_put_contents(base_path("resources/views/admin/" . Str::of($name)->camel() . "/edit.blade.php"), $listTemplate);
        $this->line('<fg=green>Create file generated</>');
    }
}
