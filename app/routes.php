<?php

$router->get('', 'PromotionController@index');

$router->post('update/{id}', 'PromotionController@update');

$router->get('{id}/{title}', 'PromotionController@show');

$router->post('import', 'ImportDataController@import');


