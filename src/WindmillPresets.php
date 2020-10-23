<?php

namespace WindmillPresets;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laravel\Ui\Presets\Preset;
use Symfony\Component\Finder\SplFileInfo;

class WindmillPresets extends Preset
{
    public static function install()
    {
        static::updatePackages();
        static::updateStyles();
        static::updateBootstrapping();
        static::updateWelcomePage();
        static::removeNodeModules();
    }

    public static function installAuth()
    {
        static::scaffoldController();
        static::scaffoldAuth();
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            '@tailwindcss/ui' => '^0.3',
            '@tailwindcss/custom-forms' => '^0.2.1',
            'alpinejs' => '^2.7.0',
            'autoprefixer' => '^9.6',
            'laravel-mix' => '^5.0.1',
            'postcss-import' => '^12.0',
            'postcss-nested' => '^4.2',
            'tailwindcss' => '^1.3.0',
            'tailwindcss-multi-theme' => '^1.0.3',
            'vue-template-compiler' => '^2.6.11',
        ], Arr::except($packages, [
            'bootstrap',
            'bootstrap-sass',
            'popper.js',
            'laravel-mix',
            'jquery',
        ]));
    }

    protected static function updateStyles()
    {
        tap(new Filesystem, function ($filesystem) {
            $filesystem->deleteDirectory(resource_path('sass'));
            $filesystem->delete(public_path('js/app.js'));
            $filesystem->delete(public_path('css/app.css'));

            if (!$filesystem->isDirectory($directory = resource_path('css'))) {
                $filesystem->makeDirectory($directory, 0755, true);
            }
        });

        copy(__DIR__ . '/../windmill-stubs/resources/css/app.css', resource_path('css/app.css'));
    }

    protected static function updateBootstrapping()
    {
        copy(__DIR__ . '/../windmill-stubs/tailwind.config.js', base_path('tailwind.config.js'));

        copy(__DIR__ . '/../windmill-stubs/colors.js', base_path('colors.js'));

        copy(__DIR__ . '/../windmill-stubs/webpack.mix.js', base_path('webpack.mix.js'));

        copy(__DIR__ . '/../windmill-stubs/resources/js/bootstrap.js', resource_path('js/bootstrap.js'));

        copy(__DIR__ . '/../windmill-stubs/resources/js/app.js', resource_path('js/app.js'));

        copy(__DIR__ . '/../windmill-stubs/resources/js/init-alpine.js', resource_path('js/init-alpine.js'));

        copy(__DIR__ . '/../windmill-stubs/resources/js/focus-trap.js', resource_path('js/focus-trap.js'));
    }

    protected static function updateWelcomePage()
    {
        (new Filesystem)->delete(resource_path('views/welcome.blade.php'));

        copy(__DIR__ . '/../windmill-stubs/resources/views/welcome.blade.php', resource_path('views/welcome.blade.php'));
    }

    protected static function scaffoldController()
    {
        if (!is_dir($directory = app_path('Http/Controllers/Auth'))) {
            mkdir($directory, 0755, true);
        }

        $filesystem = new Filesystem;

        collect($filesystem->allFiles(base_path('vendor/laravel/ui/stubs/Auth')))
            ->each(function (SplFileInfo $file) use ($filesystem) {
                $filesystem->copy(
                    $file->getPathname(),
                    app_path('Http/Controllers/Auth/' . Str::replaceLast('.stub', '.php', $file->getFilename()))
                );
            });
    }

    protected static function scaffoldAuth()
    {
        file_put_contents(app_path('Http/Controllers/HomeController.php'), static::compileControllerStub());

        file_put_contents(
            base_path('routes/web.php'),
            "Auth::routes();\n\nRoute::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');\n\n",
            FILE_APPEND
        );

        (new Filesystem)->copyDirectory(__DIR__ . '/../windmill-stubs/images', base_path('public/images'));
        tap(new Filesystem, function ($filesystem) {
            $filesystem->copyDirectory(__DIR__ . '/../windmill-stubs/resources/views', resource_path('views'));

            collect($filesystem->allFiles(base_path('vendor/laravel/ui/stubs/migrations')))
                ->each(function (SplFileInfo $file) use ($filesystem) {
                    $filesystem->copy(
                        $file->getPathname(),
                        database_path('migrations/' . $file->getFilename())
                    );
                });
        });
    }

    protected static function compileControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            Container::getInstance()->getNamespace(),
            file_get_contents(__DIR__ . '/../windmill-stubs/controllers/HomeController.stub')
        );
    }
}
