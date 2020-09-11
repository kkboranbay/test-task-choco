<?php

require 'vendor/autoload.php';
require 'services/bootstrap.php';


Router::load('app/routes.php')
    ->direct(Request::getUri(), Request::getMethod());