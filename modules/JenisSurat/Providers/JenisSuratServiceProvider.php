<?php

namespace Modules\JenisSurat\Providers;

use Laravolt\Support\Base\BaseServiceProvider;

class JenisSuratServiceProvider extends BaseServiceProvider
{
    public function getIdentifier(): string
    {
        return 'jenis-surat';
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
                    ->add('Jenis Naskah', route('modules::jenis-surat.index'))
                    ->data('icon', 'envelope')
                    ->data('permission', $this->config['permission'] ?? [])
                    ->active('modules/jenis-surat/*');
            }
        });
    }
}
