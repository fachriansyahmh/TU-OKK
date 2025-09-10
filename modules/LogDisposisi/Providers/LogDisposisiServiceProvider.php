<?php

namespace Modules\LogDisposisi\Providers;

use Laravolt\Support\Base\BaseServiceProvider;

class LogDisposisiServiceProvider extends BaseServiceProvider
{
    public function getIdentifier(): string
    {
        return 'log-disposisi';
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
                    ->add('Log Disposisi', route('modules::log-disposisi.index'))
                    ->data('icon', 'clipboard-list') // PERBAIKAN: Menggunakan nama ikon Font Awesome yang benar
                    ->data('order', 3) // Atur urutan, angka lebih besar akan di bawah
                    ->data('permission', $this->config['permission'] ?? [])
                    ->active('modules/log-disposisi/*');
            }
        });
    }
}