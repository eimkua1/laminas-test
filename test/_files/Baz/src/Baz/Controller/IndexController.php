<?php

/**
 * @see       https://github.com/laminas/laminas-test for the canonical source repository
 * @copyright https://github.com/laminas/laminas-test/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-test/blob/master/LICENSE.md New BSD License
 */

namespace Baz\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use RuntimeException;

class IndexController extends AbstractActionController
{
    /** @return array<string, string> */
    public function unittestsAction()
    {
        $this->getResponse()
            ->getHeaders()
            ->addHeaderLine('Content-Type: text/html')
            ->addHeaderLine('WWW-Authenticate: Basic realm="Laminas"');

        $numGet  = $this->getRequest()->getQuery()->get('num_get', 0);
        $numPost = $this->getRequest()->getPost()->get('num_post', 0);

        return ['num_get' => $numGet, 'num_post' => $numPost];
    }

    /** @return string */
    public function consoleAction()
    {
        return 'foo, bar';
    }

    /** @return void */
    public function persistencetestAction()
    {
        $this->flashMessenger()->addMessage('test');
    }

    /** @return Response */
    public function redirectAction()
    {
        return $this->redirect()->toUrl('https://www.zend.com');
    }

    /** @return void */
    public function exceptionAction()
    {
        throw new RuntimeException('Foo error !');
    }

    /** @return Response */
    public function customResponseAction()
    {
        $response = new Response();
        $response->setCustomStatusCode(999);

        return $response;
    }
}
