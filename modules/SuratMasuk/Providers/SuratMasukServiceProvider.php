<?php

namespace Modules\SuratMasuk\Providers;

use App\Observers\SuratMasukObserver;
use Laravolt\Support\Base\BaseServiceProvider;
use Modules\SuratMasuk\Models\SuratMasuk;

class SuratMasukServiceProvider extends BaseServiceProvider
{
    public function getIdentifier(): string
    {
        return 'surat-masuk';
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

    public function boot(): void
    {
        parent::boot();

        // Mendaftarkan observer agar memantau model SuratMasuk
        // SuratMasuk::observe(SuratMasukObserver::class);
    }

    protected function menu(): void
    {
        // Memperbaiki typo dari '\' menjadi '.'
        app('laravolt.menu.builder')->register(function ($menu) {
            if ($menu->modules) {
                $menu->modules
                    ->add('Surat Masuk', route('modules::surat-masuk.index'))
                    ->data('icon', 'envelope')
                    ->data('order', 1) // Anda bisa menggunakan data('order') untuk urutan
                    ->data('permission', $this->config['permission'] ?? [])
                    ->active('modules/surat-masuk/*');
            }
        });
    }
}
