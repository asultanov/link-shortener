<?php
/* *
 * Route list
 * */

//      http::localhost
$this->router->add('home', '/', 'HomeController@index');
$this->router->add('makeLink', '/make-link', 'LinkController@makeLink','POST');
$this->router->add('goToLink', '/go/(lnk:any)', 'LinkController@goToLink');


//      http::localhost/test/1/test_str
$this->router->add('admin', '/admin/test', 'HomeController@index');
$this->router->add('test', '/test/(id:int)/(str:str)', 'TestController@test');
