<?php

namespace Modules\Disposisi\Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use :Namespace:\:ModuleName:\Models\:ModuleName:;
use Tests\TestCase;

class DisposisiTest extends TestCase
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
        $this->get(route('modules::disposisi.index'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_create_page(): void
    {
        $this->get(route('modules::disposisi.create'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_store_data(): void
    {
        $attributes = Disposisi::factory()->raw();

        $this->post(route('modules::disposisi.store'), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_show_page(): void
    {
        $disposisi = Disposisi::factory()->create();

        $this->get(route('modules::disposisi.show', $disposisi))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_edit_page(): void
    {
        $disposisi = Disposisi::factory()->create();

        $this->get(route('modules::disposisi.edit', $disposisi))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_data(): void
    {
        $disposisi = Disposisi::factory()->create();
        $attributes = $disposisi->toArray();
        $attributes['disposisi'] = 'Updated Disposisi';

        $this->put(route('modules::disposisi.update', $disposisi), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_data(): void
    {
        $disposisi = Disposisi::factory()->create();

        $this->delete(route('modules::disposisi.destroy', $disposisi))->assertStatus(302);
    }
}
