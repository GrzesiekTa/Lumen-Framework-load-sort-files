<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/',['as'=>'home','uses'=>'HomeController@home']);
$router->get('/largest-orders',['as'=>'LargestOrders','uses'=>'DataController@LargestOrders']);
$router->get('/orders/group/{id}',['as'=>'GetOrderByGroup','uses'=>'DataController@GetOrderByGroup']);
$router->get('/customers-consonants',['as'=>'ShowCustomerConsonants','uses'=>'DataController@ShowCustomerConsonants']);
$router->get('/statutes-files',['as'=>'StatutesInFiles','uses'=>'DataController@StatutesInFiles']);