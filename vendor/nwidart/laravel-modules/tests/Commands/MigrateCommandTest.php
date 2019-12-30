<?php

namespace Nwidart\Modules\tests\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Nwidart\Modules\Repository;
use Nwidart\Modules\Tests\BaseTestCase;

abstract class MigrateCommandTest extends BaseTestCase
{
    /**
     * @var Repository
     */
    private $repository;
    /**
     * @var Filesystem
     */
    private $finder;

    public function setUp()
    {
        parent::setUp();
        $this->repository = new Repository($this->app);
        $this->finder = $this->app['files'];
    }

    /** @test */
    public function it_migrates_a_module()
    {
        $this->repository->addLocation(__DIR__ . '/../stubs/Recipe');

        $this->artisan('module:migrate', ['module' => 'Recipe']);

        dd(Schema::hasTable('recipe__recipes'), $this->app['db']->table('recipe__recipes')->get());
    }
}
