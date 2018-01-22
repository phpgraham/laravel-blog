<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PageTest extends TestCase
{
    use DatabaseMigrations;

    protected $page;

    public function setUp()
    {
        parent::setUp();
        $this->page = create('App\Pages');
    }

    /** @test */
    function a_page_has_a_path()
    {
        $page = create('App\Pages');
        $this->assertEquals(
            "/blog/{$page->slug}", $page->path()
        );
    }
}
