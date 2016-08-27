<?php

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::defaultRouteClass('DashedRoute');

Router::prefix('admin', function (RouteBuilder $routes) {

    $routes->connect('/view/:id', ['controller' => 'Admin', 'action' => 'view'], ['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/edit/:id', ['controller' => 'Admin', 'action' => 'edit'], ['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/delete/:id', ['controller' => 'Admin', 'action' => 'delete'], ['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/index',  ['controller' => 'Admin', 'action' => 'index']);
    $routes->connect('/',  ['controller' => 'Admin', 'action' => 'index']);
    $routes->connect('/add',    ['controller' => 'Admin', 'action' => 'add']);
    $routes->connect('/login',  ['controller' => 'Admin', 'action' => 'login']);
    $routes->connect('/logout', ['controller' => 'Admin', 'action' => 'logout']);
    $routes->connect('/ranking/run', ['controller' => 'Admin', 'action' => 'adminRunRankingFortune']);


    $routes->fallbacks('DashedRoute');
});

Router::scope('/', function (RouteBuilder $routes) {
    $routes->extensions(['csv']);
    $routes->connect('/', ['controller' => 'User', 'action' => 'getListFortune']);
    $routes->connect('/user/login', ['controller' => 'User', 'action' => 'login']);
    $routes->connect('/user/logout', ['controller' => 'User', 'action' => 'logout']);
    $routes->connect('/fortune/login', ['controller' => 'Fortunes', 'action' => 'login']);
    $routes->connect('/fortune/logout', ['controller' => 'Fortunes', 'action' => 'logout']);
    $routes->connect('/rev', ['controller' => 'User', 'action' => 'comment']);
    $routes->fallbacks('DashedRoute');
});

Router::prefix('fortune', function (RouteBuilder $routes) {
    
    $routes->connect('/set_schedule',['controller'   =>   'Fortunes', 'action' => 'setSchedule']);

    $routes->connect('/today_schedule',['controller' => 'Fortunes', 'action' => 'todaySchedule']);

    $routes->connect('/history_teller',['controller' => 'Fortunes', 'action' => 'historyTeller']);

    $routes->connect('/excute_history',['controller' => 'Fortunes', 'action' => 'excuteHistory']);


    $routes->connect('/history_month',['controller' => 'Fortunes', 'action' => 'excuteHistoryByMonth ']);
    $routes->connect('/messages',['controller' => 'Fortunes', 'action' => 'messages ']);

    $routes->fallbacks('DashedRoute');

});

Router::connect('/ranking',['controller' => 'Fortunes', 'action' => 'rankingFortune']);
Router::connect('/freec', ['controller' => 'FortuneFree', 'action' => 'index']);
Router::connect('/freec/add', ['controller' => 'FortuneFree', 'action' => 'add']);
Router::connect('/freec/view/:id', ['controller' => 'FortuneFree', 'action' => 'view',['pass' => ['id'], 'id' => '[0-9]+']]);
/*End feec*/
Router::connect('/fortune_detail/:id', ['controller' => 'User', 'action' => 'FortuneDetail']);
Router::connect('/list_fortune/view/:id', ['controller' => 'Fortunes', 'action' => 'view'], ['pass' => ['id'], 'id' => '[0-9]+']);
Router::connect('/searchFr', ['controller' => 'Fortunes', 'action' => 'searchFortune']);
Router::connect('/use_point', ['controller' => 'User', 'action' => 'getUserPoint']);
Router::connect('/test', ['controller' => 'Fortunes', 'action' => 'tests']);
Router::connect('/search-fortune',['controller' => 'Fortunes', 'action' => 'findFortune']);

Plugin::routes();
