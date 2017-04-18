<?php

define('ROOT',$_SERVER['DOCUMENT_ROOT'].'/../app/');
try {
    include_once(checkFile(ROOT.'config/config.php'));

    require_once(checkFile(CORE_ROOT.'Router.php'));
    $router = new Router();
    $router->run();
} catch (Throwable $t) {
    echo $t->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}

function checkFile($path = '')
{
    if (!$path || !file_exists($path)) {
        throw new Exception('No Such file: '.$path);
    }
    return $path;
}