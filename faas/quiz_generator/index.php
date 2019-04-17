<?php

require __DIR__.'/vendor/autoload.php';
use App\Handler;

$data = '';

while (false !== ($line = fgets(STDIN))) {
    $data .= $line;
}

$handler = new Handler;
echo $handler->handle($data);


