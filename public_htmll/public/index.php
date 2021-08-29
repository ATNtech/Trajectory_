<?php

use fw\core\Router;

//$query = rtrim($_SERVER['QUERY_STRING'], '/');
$query = trim(str_replace('?','&',$_SERVER['REQUEST_URI']), '/');

define("DEBUG", 1);
define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/fw/core');
define('ROOT', dirname(__DIR__));
define('LIBS', dirname(__DIR__) . '/vendor/fw/libs');
define('APP', dirname(__DIR__) . '/app');
define('CACHE', dirname(__DIR__) . '/tmp/cache');
define('BASE_URL', str_replace('\\','/',str_replace("public", '',dirname($_SERVER["SCRIPT_NAME"]))));
define('BASE_PATH', str_replace('\\','/',realpath('.')).'/');
define('LAYOUT', 'blog');
define('ADMIN', '/admin');

require '../vendor/fw/libs/functions.php';
require __DIR__ . '/../vendor/autoload.php';

/*spl_autoload_register(function($class){
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if(is_file($file)){
        require_once $file;
    }
});*/

new \fw\core\App;

Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

// defaults routs
Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

Router::add('^obrnadzor$', ['controller' => 'Main', 'action' => 'obrnadzor']);
Router::add('^minobr$', ['controller' => 'Main', 'action' => 'minobr']);
Router::add('^dgis$', ['controller' => 'Main', 'action' => 'dgis']);
Router::add('^dgisall$', ['controller' => 'Main', 'action' => 'dgisall']);
Router::add('^dgisschools$', ['controller' => 'Main', 'action' => 'dgisschools']);
Router::add('^dgiskinders$', ['controller' => 'Main', 'action' => 'dgiskinders']);
Router::add('^dgisvuz$', ['controller' => 'Main', 'action' => 'dgisvuz']);
Router::add('^vsu$', ['controller' => 'Main', 'action' => 'vsu']);
Router::add('^obrros$', ['controller' => 'Main', 'action' => 'obrros']);
Router::add('^vk$', ['controller' => 'Main', 'action' => 'vk']);
Router::add('^land$', ['controller' => 'Main', 'action' => 'land']);
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');


Router::dispatch($query);