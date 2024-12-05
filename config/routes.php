<?php

use \wfm\Router;


Router::add('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'admin']); //обработка admin страницы 
Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['admin_prefix' => 'admin']); //обработка admin/....../.....
Router::add('^$', ['controller' => 'Main', 'action' => 'index']); //обработка главной страницы контроллером Main, экшеном  index, т.е. дефолтная обработка
Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$'); //обработка страниц, состоящих из ....../.......  
// Router::add('^(?P<controller>[a-z-]+)(/(?P<action>[a-z-]+))?$');//action не обязателен   
