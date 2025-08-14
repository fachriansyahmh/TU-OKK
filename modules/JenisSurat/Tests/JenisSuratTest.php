<?php

namespace Modules\JenisSurat\Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use :Namespace:\:ModuleName:\Models\:ModuleName:;
use Tests\TestCase;

class JenisSuratTest extends TestCase
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
        $this->get(route('modules::jenis-surat.index'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_create_page(): void
    {
        $this->get(route('modules::jenis-surat.create'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_store_data(): void
    {
        $attributes = JenisSurat::factory()->raw();

        $this->post(route('modules::jenis-surat.store'), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_show_page(): void
    {
        $jenisSurat = JenisSurat::factory()->create();

        $this->get(route('modules::jenis-surat.show', $jenisSurat))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_edit_page(): void
    {
        $jenisSurat = JenisSurat::factory()->create();

        $this->get(route('modules::jenis-surat.edit', $jenisSurat))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_data(): void
    {
        $jenisSurat = JenisSurat::factory()->create();
        $attributes = $jenisSurat->toArray();
        $attributes['jenis_surat'] = 'Updated Jenis Surat';

        $this->put(route('modules::jenis-surat.update', $jenisSurat), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_data(): void
    {
        $jenisSurat = JenisSurat::factory()->create();

        $this->delete(route('modules::jenis-surat.destroy', $jenisSurat))->assertStatus(302);
    }
}
