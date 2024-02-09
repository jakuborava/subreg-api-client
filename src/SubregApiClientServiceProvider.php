<?php

namespace Jakuborava\SubregApiClient;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Jakuborava\SubregApiClient\Commands\SubregApiClientCommand;

class SubregApiClientServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('subreg-api-client')
            ->hasConfigFile();
    }
}
