<?php

//header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/Lib/Livro/Core/ClassLoader.php';
require_once __DIR__ . '/Lib/Livro/Core/AppLoader.php';

$al = new Livro\Core\ClassLoader;
$al->addNamespace('Livro', 'Lib/Livro');
$al->register();

$al = new Livro\Core\AppLoader;
$al->addDirectory('App/Control');
$al->addDirectory('App/Model');
$al->addDirectory('App/Services');
$al->register();

class LivroRestServer
{
    public static function run($requets)
    {
        $class = isset($requets['class']) ? $requets['class'] : '';
        $method = isset($requets['method']) ? $requets['method'] : '';

        try {
            if (class_exists($class)) {
                if (method_exists($class, $method)) {
                    $response = call_user_func([$class, $method], $requets);

                    return json_encode([
                        'status' => 'sucess',
                        'data' => $response
                    ]);
                } else {
                    return json_encode([
                        'status' => 'error',
                        'data' => "Método {$method} não encontrado"
                    ]);
                }
            } else {
                return json_encode([
                    'status' => 'error',
                    'data' => "Classe {$class} não encontrado"
                ]);
            }
        } catch (Exception $e) {
            return json_encode([
                'status' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
}

print LivroRestServer::run($_REQUEST);
