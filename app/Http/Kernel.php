<?php

namespace App\Http;

use App\Http\Middleware\AddXHeader;
use App\Http\Middleware\AdminMenu;
use App\Http\Middleware\ApiCompany;
use App\Http\Middleware\CanInstall;
use App\Http\Middleware\CustomerMenu;
use App\Http\Middleware\DateFormat;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\LoadCurrencies;
use App\Http\Middleware\LoadSettings;
use App\Http\Middleware\Money;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfNotInstalled;
use App\Http\Middleware\RedirectIfWizardCompleted;
use App\Http\Middleware\SignedUrlCompany;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\VerifyCsrfToken;
use Fideloper\Proxy\TrustProxies;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Laratrust\Middleware\LaratrustAbility;
use Laratrust\Middleware\LaratrustPermission;
use Laratrust\Middleware\LaratrustRole;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        CheckForMaintenanceMode::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
        TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            RedirectIfNotInstalled::class,
            AddXHeader::class,
            'company.settings',
            'company.currencies',
            RedirectIfWizardCompleted::class,
        ],

        'wizard' => [
            'web',
            'language',
            'auth',
            'permission:read-admin-panel',
        ],

        'admin' => [
            'web',
            'language',
            'auth',
            'adminmenu',
            'permission:read-admin-panel',
        ],

        'customer' => [
            'web',
            'language',
            'auth',
            'customermenu',
            'permission:read-customer-panel',
        ],

        'api' => [
            'api.auth',
            'throttle:60,1',
            'bindings',
            'api.company',
            'permission:read-api',
            'company.settings',
            'company.currencies',
        ],

        'signed' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            'signed-url',
            'signed-url.company',
            SubstituteBindings::class,
            AddXHeader::class,
            'company.settings',
            'company.currencies',
        ]
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'bindings' => SubstituteBindings::class,
        'can' => Authorize::class,
        'guest' => RedirectIfAuthenticated::class,
        'throttle' => ThrottleRequests::class,
        'adminmenu' => AdminMenu::class,
        'customermenu' => CustomerMenu::class,
        'role' => LaratrustRole::class,
        'permission' => LaratrustPermission::class,
        'ability' => LaratrustAbility::class,
        'api.company' => ApiCompany::class,
        'install' => CanInstall::class,
        'company.settings' => LoadSettings::class,
        'company.currencies' => LoadCurrencies::class,
        'dateformat' => DateFormat::class,
        'money' => Money::class,
        'signed-url.company' => SignedUrlCompany::class,
    ];
}
