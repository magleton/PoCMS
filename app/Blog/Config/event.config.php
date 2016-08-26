<?php
$event_config = [
    "event_namespace" => [
        "Events::prePersist" => 'Blog\listener\MyEventListener',
    ]
];
return $event_config;