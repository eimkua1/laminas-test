<?php

/**
 * @see       https://github.com/laminas/laminas-test for the canonical source repository
 * @copyright https://github.com/laminas/laminas-test/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-test/blob/master/LICENSE.md New BSD License
 */

namespace ModuleWithEvents;

use Laminas\Mvc\Application;
use Laminas\Mvc\MvcEvent;

class Module
{
    /** @return void */
    public function onBootstrap(MvcEvent $e)
    {
        $application = $e->getApplication();
        $events      = $application->getEventManager();
        $events->attach(MvcEvent::EVENT_ROUTE, [$this, 'onRoute'], -1000);
    }

    /** @return void */
    public function onRoute(MvcEvent $e)
    {
        $routeMatch = $e->getRouteMatch();
        if ($routeMatch->getMatchedRouteName() === "myroutebis") {
            return;
        }

        $application = $e->getApplication();
        $events      = $application->getEventManager()->getSharedManager();
        $events->attach(Application::class, MvcEvent::EVENT_FINISH, function ($e) use ($application) {
            $response = $application->getResponse();
            $response->setContent("<html></html>");
        }, 1000000);
    }
}
