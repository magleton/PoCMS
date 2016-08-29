<?php
$common_config = [
    'slim' => [
        'settings' => [
            'httpVersion' => '1.1',
            'responseChunkSize' => 4096,
            'outputBuffering' => 'append',
            'addContentLengthHeader' => 1,
        ]
    ],
];

return $common_config;