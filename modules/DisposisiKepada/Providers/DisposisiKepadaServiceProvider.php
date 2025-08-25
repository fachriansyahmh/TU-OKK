<?php

namespace Modules\DisposisiKepada\Providers;

use Laravolt\Support\Base\BaseServiceProvider;

class DisposisiKepadaServiceProvider extends BaseServiceProvider
{
    public function getIdentifier(): string
    {
        return 'disposisi-kepada';
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
                    ->add('Disposisi Kepada', route('modules::disposisi-kepada.index'))
                    ->data('icon', 'circle')
                    ->data('permission', $this->config['permission'] ?? [])
                    ->active('modules/disposisi-kepada/*');
            }
        });
    }
}
