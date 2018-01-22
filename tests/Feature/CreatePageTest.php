<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreatePageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function an_authenticated_user_can_create_new_pages()
    {
        $this->signIn();
        $response = $this->publishPage(['title' => 'Some Title', 'content' => 'Some content.']);
        $this->get($response->headers->get('Location'))
            ->assertSee('Some Title')
            ->assertSee('Some content.');
    }
    /** @test */
    function a_page_requires_a_title()
    {
        $this->publishPage(['title' => null])
            ->assertSessionHasErrors('title');
    }
    /** @test */
    function a_page_requires_a_content()
    {
        $this->publishPage(['content' => null])
            ->assertSessionHasErrors('content');
    }

    /** @test */
    function a_page_requires_a_unique_slug()
    {
        $this->signIn();
        $page = create('App\Pages', ['title' => 'Foo Title']);
        $this->assertEquals($page->fresh()->slug, 'foo-title');
        $page = $this->postJson(route('blog'), $page->toArray())->json();
        $this->assertEquals("foo-title-{$page['id']}", $page['slug']);
    }

    protected function publishPage($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        $page = make('App\Pages', $overrides);
        return $this->post(route('blog'), $page->toArray());
    }

}
