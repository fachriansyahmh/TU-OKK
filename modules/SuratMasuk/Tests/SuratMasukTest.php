<?php

namespace Modules\SuratMasuk\Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use :Namespace:\:ModuleName:\Models\:ModuleName:;
use Tests\TestCase;

class SuratMasukTest extends TestCase
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
        $this->get(route('modules::surat-masuk.index'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_create_page(): void
    {
        $this->get(route('modules::surat-masuk.create'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_store_data(): void
    {
        $attributes = SuratMasuk::factory()->raw();

        $this->post(route('modules::surat-masuk.store'), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_show_page(): void
    {
        $suratMasuk = SuratMasuk::factory()->create();

        $this->get(route('modules::surat-masuk.show', $suratMasuk))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_edit_page(): void
    {
        $suratMasuk = SuratMasuk::factory()->create();

        $this->get(route('modules::surat-masuk.edit', $suratMasuk))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_data(): void
    {
        $suratMasuk = SuratMasuk::factory()->create();
        $attributes = $suratMasuk->toArray();
        $attributes['status'] = 'Updated Status';
        $attributes['sifat_naskah'] = 'Updated Sifat Naskah';

        $this->put(route('modules::surat-masuk.update', $suratMasuk), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_data(): void
    {
        $suratMasuk = SuratMasuk::factory()->create();

        $this->delete(route('modules::surat-masuk.destroy', $suratMasuk))->assertStatus(302);
    }
}
