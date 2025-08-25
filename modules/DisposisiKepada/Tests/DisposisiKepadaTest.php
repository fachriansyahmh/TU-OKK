<?php

namespace Modules\DisposisiKepada\Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use :Namespace:\:ModuleName:\Models\:ModuleName:;
use Tests\TestCase;

class DisposisiKepadaTest extends TestCase
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
        $this->get(route('modules::disposisi-kepada.index'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_create_page(): void
    {
        $this->get(route('modules::disposisi-kepada.create'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_store_data(): void
    {
        $attributes = DisposisiKepada::factory()->raw();

        $this->post(route('modules::disposisi-kepada.store'), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_show_page(): void
    {
        $disposisiKepada = DisposisiKepada::factory()->create();

        $this->get(route('modules::disposisi-kepada.show', $disposisiKepada))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_edit_page(): void
    {
        $disposisiKepada = DisposisiKepada::factory()->create();

        $this->get(route('modules::disposisi-kepada.edit', $disposisiKepada))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_data(): void
    {
        $disposisiKepada = DisposisiKepada::factory()->create();
        $attributes = $disposisiKepada->toArray();
        $attributes['disposisi_kepada'] = 'Updated Content';

        $this->put(route('modules::disposisi-kepada.update', $disposisiKepada), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_data(): void
    {
        $disposisiKepada = DisposisiKepada::factory()->create();

        $this->delete(route('modules::disposisi-kepada.destroy', $disposisiKepada))->assertStatus(302);
    }
}
