<?php

namespace Minasyans\Ttall;

use Illuminate\Support\Arr;
use Laravel\Ui\Presets\Preset;

class Ttall extends Preset
{
    use HandlesAuthScaffolding;
    use HandlesGeneralScaffolding;
    use HandlesCodeHelperScaffolding;

    const NPM_PACKAGES_TO_ADD = [
        'autoprefixer' => '^10.1.0',
        'alpinejs' => '^3.1.1',
        'postcss' => '^8.2.1',
        'postcss-import' => '^12.0.1',
        'tailwindcss' => '^2.2.4',
        'turbolinks' => '^5.2.0',
    ];

    const DEV_NPM_PACKAGES_TO_ADD = [
        'eslint' => '^7.7.0',
        'eslint-config-airbnb' => '^18.2.0',
        'eslint-config-prettier' => '^6.11.0',
        'eslint-plugin-import' => '^2.22.0',
        'eslint-plugin-jsx-a11y' => '^6.3.1',
        'eslint-plugin-react' => '^7.20.6',
        'eslint-plugin-react-hooks' => '^4.1.0',
        'prettier' => '^2.0.5',
        'laravel-mix' => '^6.0.0',
    ];

    const NPM_PACKAGES_TO_REMOVE = [
        'axios',
        'laravel-mix',
        'lodash',
    ];

    public static function install(): void
    {
        static::updatePackages();
        static::updatePackages(false);
        static::updateComposerPackages();
        static::updateComposerPackages(false);
        static::updatePackagesScripts();
        static::scaffoldDefaults();
    }

    public static function installAuth(): void
    {
        static::scaffoldAuth();

        static::scaffoldAuthController();
    }

    public static function installCodeHelpers(): void
    {
        static::updateCodeHelperComposerPackages();
        static::updateCodeHelperComposerPackages(false);
        static::updateCodeHelperPackagesScripts();
        static::updateCodeHelperComposerScripts();
        static::updateCodeHelperComposerExtra();
    }

    protected static function updatePackageArray(array $packages, string $dev): array
    {
        if ($dev == 'devDependencies') {
            return array_merge(
                static::DEV_NPM_PACKAGES_TO_ADD,
                Arr::except($packages, static::NPM_PACKAGES_TO_REMOVE)
            );
        }

        return array_merge(
            static::NPM_PACKAGES_TO_ADD,
            Arr::except($packages, static::NPM_PACKAGES_TO_REMOVE)
        );
    }
}
