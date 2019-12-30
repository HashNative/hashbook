<?php

namespace Nwidart\Menus\Tests;

use Collective\Html\HtmlServiceProvider;
use Illuminate\Foundation\Application;
use Nwidart\Menus\MenusServiceProvider;
use Nwidart\Menus\Presenters\Bootstrap\NavbarPresenter;
use Nwidart\Menus\Presenters\Bootstrap\NavbarRightPresenter;
use Nwidart\Menus\Presenters\Bootstrap\NavMenuPresenter;
use Nwidart\Menus\Presenters\Bootstrap\NavPillsPresenter;
use Nwidart\Menus\Presenters\Bootstrap\NavTabPresenter;
use Nwidart\Menus\Presenters\Bootstrap\SidebarMenuPresenter;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class BaseTestCase extends OrchestraTestCase
{
    public function setUp()
    {
        parent::setUp();

        // $this->setUpDatabase();
    }

    protected function getPackageProviders($app)
    {
        return [
            HtmlServiceProvider::class,
            MenusServiceProvider::class,
        ];
    }

    /**
     * Set up the environment.
     *
     * @param Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('menus', [
            'styles' => [
                'navbar' => NavbarPresenter::class,
                'navbar-right' => NavbarRightPresenter::class,
                'nav-pills' => NavPillsPresenter::class,
                'nav-tab' => NavTabPresenter::class,
                'sidebar' => SidebarMenuPresenter::class,
                'navmenu' => NavMenuPresenter::class,
            ],

            'ordering' => false,
        ]);
    }
}
