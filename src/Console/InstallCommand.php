<?php

namespace Imagdic\Blitz\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'blitz:install';

    /**
     * @var string
     */
    protected $description = 'Scaffold the minimal authentication with Inertia.js, Vue.js and Tailwind';

    public function handle()
    {
        // Composer Packages
        $this->requireComposerPackages([
            'inertiajs/inertia-laravel:^0.3.4',
            'tightenco/ziggy:^1.0'
        ]);

        // NPM Packages
        $this->updateNodePackages(function ($packages) {
            return [
                    '@inertiajs/inertia' => '^0.7.0',
                    '@inertiajs/inertia-vue' => '^0.4.3',
                    '@inertiajs/progress' => '^0.2.2',
                    '@tailwindcss/forms' => '^0.2.1',
                    'tailwindcss' => 'npm:@tailwindcss/postcss7-compat@^2.0.1',
                    'postcss-import' => '^12.0.1',
                    'autoprefixer' => '^9.8.6',
                    'vue' => '^2.6.12',
                    'vue-template-compiler' => '^2.6.12',
                ] + $packages;
        });

        // Controllers
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/Auth'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/App/Http/Controllers/Auth',
            app_path('Http/Controllers/Auth'));

        // Requests
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests/Auth'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/App/Http/Requests/Auth',
            app_path('Http/Requests/Auth'));

        // Views
        copy(__DIR__ . '/../../stubs/resources/views/app.blade.php', resource_path('views/app.blade.php'));

        // Routes
        copy(__DIR__ . '/../../stubs/routes/web.php', base_path('routes/web.php'));

        // Tailwind / Webpack
        copy(__DIR__ . '/../../stubs/tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__ . '/../../stubs/webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__ . '/../../stubs/resources/css/app.css', resource_path('css/app.css'));
        copy(__DIR__ . '/../../stubs/resources/js/app.js', resource_path('js/app.js'));

        // Components and Pages
        (new Filesystem)->ensureDirectoryExists(resource_path('js/Components'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/Pages'));

        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/js/Components',
            resource_path('js/Components'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/js/Pages', resource_path('js/Pages'));

        $this->info('Blitz scaffolding finished.');
        $this->comment('Please execute the "npm install && npm run dev" command to build your assets.');
    }

    /**
     * Installs the given Composer Packages into the application.
     *
     * @param mixed $packages
     * @return void
     */
    protected function requireComposerPackages($packages)
    {
        $command = array_merge(
            ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Update the "package.json" file.
     *
     * @param callable $callback
     * @param bool $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (!file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
        );
    }
}
