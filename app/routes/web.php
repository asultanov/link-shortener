<?php
/* *
 * Route list
 * */

//      http::localhost
$this->router->add('home', '/', 'HomeController@index');
$this->router->add('admin', '/admin/', 'HomeController@index');
//      http::localhost/test/1/test_str
$this->router->add('test', '/test/(id:int)/(str:str)', 'HomeController@test');

// POST-http::localhost/
$this->router->add('test_post', '/testPost', 'HomeController@testPost','POST');
