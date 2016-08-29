<?php
$app = \Core\Utils\CoreUtils::getContainer('app');

$app->get("/hello/show", "Blog\controller\Hello:show")->setName("hello.show");
