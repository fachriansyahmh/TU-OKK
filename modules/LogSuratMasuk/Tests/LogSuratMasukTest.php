<?php

namespace Modules\LogSuratMasuk\Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use :Namespace:\:ModuleName:\Models\:ModuleName:;
use Tests\TestCase;

class LogSuratMasukTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @var User */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_index_page(): void
    {
        $this->get(route('modules::log-surat-masuk.index'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_create_page(): void
    {
        $this->get(route('modules::log-surat-masuk.create'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_store_data(): void
    {
        $attributes = LogSuratMasuk::factory()->raw();

        $this->post(route('modules::log-surat-masuk.store'), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_show_page(): void
    {
        $logSuratMasuk = LogSuratMasuk::factory()->create();

        $this->get(route('modules::log-surat-masuk.show', $logSuratMasuk))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_edit_page(): void
    {
        $logSuratMasuk = LogSuratMasuk::factory()->create();

        $this->get(route('modules::log-surat-masuk.edit', $logSuratMasuk))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_data(): void
    {
        $logSuratMasuk = LogSuratMasuk::factory()->create();
        $attributes = $logSuratMasuk->toArray();
        $attributes['action'] = 'Updated Action';
        $attributes['description'] = 'Updated Description';

        $this->put(route('modules::log-surat-masuk.update', $logSuratMasuk), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_data(): void
    {
        $logSuratMasuk = LogSuratMasuk::factory()->create();

        $this->delete(route('modules::log-surat-masuk.destroy', $logSuratMasuk))->assertStatus(302);
    }
}
