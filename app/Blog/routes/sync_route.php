<?php
$app = \boot\Bootstrap::getPimple("app");
$app->addRoutes([
    "/sync/test" => [
        "Synchronization:sync"
    ],

    "/sync/add" => [
        "Synchronization:add",
        function () {
        },
    ],
]);