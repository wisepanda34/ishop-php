<?php

use \wfm\Router;


Router::add('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'admin']); //обработка admin страницы 
Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['admin_prefix' => 'admin']); //обработка admin/....../.....

Router::add('^(?P<lang>[a-z]+)?/?product/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'View']);

Router::add('^(?P<lang>[a-z]+)?/?$', ['controller' => 'Main', 'action' => 'index']); //обработка главной страницы контроллером Main, экшеном  index, т.е. дефолтная обработка
Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$'); //обработка страниц, состоящих из ....../.......  
// Router::add('^(?P<controller>[a-z-]+)(/(?P<action>[a-z-]+))?$');//action не обязателен   
