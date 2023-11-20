<?php

namespace DanTheCoder\Installer;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class InstallerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('installer')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoute('../routes/web');

        $this->app['router']->aliasMiddleware('install_completed', \DanTheCoder\Installer\Http\Middleware\InstallCompleted::class);
    }
}
