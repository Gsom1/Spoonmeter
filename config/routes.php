<?php

use App\Controller\ApiController;
use App\Controller\LocaleController;
use App\Controller\MeterController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {

    $routes->add('no_locale', '/')
        ->controller([LocaleController::class, 'detectLocale'])
    ;

    $routes->add('meter_home', '/{_locale}')
        ->controller([MeterController::class, 'index'])
    ;

    $routes->add('meter', '/{_locale}/meter')
        ->controller([MeterController::class, 'index'])

        // if the action is implemented as the __invoke() method of the
        // controller class, you can skip the 'method_name' part:
        // ->controller(BlogController::class)
    ;

    $routes->add('meter', '/{_locale}/meter/{substance}/{amount}/{from}/{to}')
        ->controller([MeterController::class, 'convert'])
    ;

    $routes->add('ajax', '/api/v1/convert')
        ->controller([ApiController::class, 'convert'])
    ;
};