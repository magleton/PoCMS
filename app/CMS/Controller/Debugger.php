<?php
/**
 * User: macro chen <chen_macro@163.com>
 * Date: 17-4-10
 * Time: 上午11:06
 */

namespace CMS\Controller;

use Polymer\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class Debugger extends Controller
{
    public function debugger(Request $request, Response $response, $args)
    {
        debugger();
        $this->render('/debugger/debugger.twig');
    }
}