<?php

namespace Modules\LogSuratMasuk\Providers;

use Laravolt\Support\Base\BaseServiceProvider;

class LogSuratMasukServiceProvider extends BaseServiceProvider
{
    public function getIdentifier(): string
    {
        return 'log-surat-masuk';
    }

    public function register(): void
    {
        $file = $this->packagePath("config/{$this->getIdentifier()}.php");
        $this->mergeConfigFrom($file, "modules.{$this->getIdentifier()}");
        $this->publishes([$file => config_path("modules/{$this->getIdentifier()}.php")], 'config');

        $configArray = config("modules.{$this->getIdentifier()}");
        if (is_array($configArray)) {
            $this->config = collect($configArray);
        }
    }

    protected function menu(): void
    {
        app('laravolt.menu.builder')->register(function ($menu) {
            if ($menu->modules) {
                $menu->modules
                    ->add('Log Surat Masuk', route('modules::log-surat-masuk.index'))
                    ->data('icon', 'history')
                    ->data('order', 2) // Anda bisa menggunakan data('order') untuk urutan
                    ->data('permission', $this->config['permission'] ?? [])
                    ->active('modules/log-surat-masuk/*');
            }
        });
    }
}
