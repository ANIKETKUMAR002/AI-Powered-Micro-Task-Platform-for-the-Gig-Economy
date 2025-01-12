<?php

require __DIR__ . '/vendor/autoload.php';

use Ratchet\App;
use App\WebSocket\Server;

$port = 8080; // Define your WebSocket server port
$app = new App('localhost', $port);
$app->route('/bids', new Server, ['*']);
$app->run();
