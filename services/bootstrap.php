<?php


App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(
    Connector::make(App::get('config')['database'])
));