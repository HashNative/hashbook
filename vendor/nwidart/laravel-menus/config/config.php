<?php

use Nwidart\Menus\Presenters\Admin\AdminltePresenter;
use Nwidart\Menus\Presenters\Bootstrap\NavbarPresenter;
use Nwidart\Menus\Presenters\Bootstrap\NavbarRightPresenter;
use Nwidart\Menus\Presenters\Bootstrap\NavMenuPresenter;
use Nwidart\Menus\Presenters\Bootstrap\NavPillsPresenter;
use Nwidart\Menus\Presenters\Bootstrap\NavTabPresenter;
use Nwidart\Menus\Presenters\Bootstrap\SidebarMenuPresenter;
use Nwidart\Menus\Presenters\Foundation\ZurbMenuPresenter;

return [

    'styles' => [
        'navbar' => NavbarPresenter::class,
        'navbar-right' => NavbarRightPresenter::class,
        'nav-pills' => NavPillsPresenter::class,
        'nav-tab' => NavTabPresenter::class,
        'sidebar' => SidebarMenuPresenter::class,
        'navmenu' => NavMenuPresenter::class,
        'adminlte' => AdminltePresenter::class,
        'zurbmenu' => ZurbMenuPresenter::class,
    ],

    'ordering' => false,

];
