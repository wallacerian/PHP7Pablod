<?php

require_once 'Lib/Livro/Core/ClassLoader.php';
require_once 'Lib/Livro/Control/Page.php';

$al = new Livro\Core\ClassLoader;
$al->addNamespace('Livro', 'Lib/Livro');
$al->register();

require_once 'Lib/Livro/Core/AppLoader.php';

$al = new Livro\Core\AppLoader;
$al->addDirectory('App/Control');
$al->register();

$loader = require 'vendor/autoload.php';
$loader->register();

if ($_GET) {
    $class = $_GET['class'];

    if (class_exists($class)) {
        $pagina = new $class;
        $pagina->show();
    }
}

echo '<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">';
echo '<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';