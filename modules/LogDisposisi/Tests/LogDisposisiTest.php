<?php

namespace Modules\LogDisposisi\Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use :Namespace:\:ModuleName:\Models\:ModuleName:;
use Tests\TestCase;

class LogDisposisiTest extends TestCase
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
        $this->get(route('modules::log-disposisi.index'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_create_page(): void
    {
        $this->get(route('modules::log-disposisi.create'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_store_data(): void
    {
        $attributes = LogDisposisi::factory()->raw();

        $this->post(route('modules::log-disposisi.store'), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_show_page(): void
    {
        $logDisposisi = LogDisposisi::factory()->create();

        $this->get(route('modules::log-disposisi.show', $logDisposisi))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_edit_page(): void
    {
        $logDisposisi = LogDisposisi::factory()->create();

        $this->get(route('modules::log-disposisi.edit', $logDisposisi))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_data(): void
    {
        $logDisposisi = LogDisposisi::factory()->create();
        $attributes = $logDisposisi->toArray();
        $attributes['action'] = 'Updated Action';
        $attributes['description'] = 'Updated Description';

        $this->put(route('modules::log-disposisi.update', $logDisposisi), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_data(): void
    {
        $logDisposisi = LogDisposisi::factory()->create();

        $this->delete(route('modules::log-disposisi.destroy', $logDisposisi))->assertStatus(302);
    }
}
