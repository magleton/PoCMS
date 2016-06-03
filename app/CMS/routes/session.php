<?php
//http://nesbot.com/2012/11/5/lazy-loading-slim-controllers-using-pimple
$app = \boot\Bootstrap::getPimple("app");
$app->get("/", function () {
    echo "hello kitty";
});

$app->get('/hello/:name', function ($name) use ($app, $view, $entityManager) {
    $userName = "aass";
    echo "asdasdas";
    $user = new \Entity\User();
    $user->setName($userName);

    $user->setPassword(md5('1234'));

    $user->setAge(time());

    $entityManager->persist($user);
    $entityManager->flush();

    echo "Created Product with ID " . $user->getId() . "\n";
    //print_r(get_class_methods($view));
    $view->display('test.html', array('the' => 'variables', 'go' => 'here'));
    echo "Hello, $name";
});
