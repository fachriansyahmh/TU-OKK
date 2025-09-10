<?php

namespace Modules\Disposisi\Providers;

use Laravolt\Support\Base\BaseServiceProvider;

class DisposisiServiceProvider extends BaseServiceProvider
{
    public function getIdentifier(): string
    {
        return 'disposisi';
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
                    ->add('Disposisi', route('modules::disposisi.index'))
                    ->data('icon', 'share')
                    ->data('order', 5)
                    ->data('permission', $this->config['permission'] ?? [])
                    ->active('modules/disposisi/*');
            }
        });
    }
}
