<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//Admin : user management
$route['users/employees'] = 'users/employees';
$route['users/export'] = 'users/export';
$route['users/import'] = 'users/import';
$route['users/reset/(:num)'] = 'users/reset/$1';
$route['users/create'] = 'users/create';
$route['users/edit/(:num)'] = 'users/edit/$1';
$route['users/delete/(:num)'] = 'users/delete/$1';
$route['users/(:num)'] = 'users/view/$1';
$route['users/check/login'] = 'users/check_login';
$route['users'] = 'users';

//Session management
$route['connection/login'] = 'connection/login';
$route['connection/logout'] = 'connection/logout';
$route['connection/language'] = 'connection/language';
$route['connection/forgetpassword'] = 'connection/forgetpassword';

//Tests
$route['tests'] = 'tests/index';
$route['tests/select'] = 'tests/select';
$route['tests/export'] = 'tests/export';
$route['tests/create'] = 'tests/create';
$route['tests/(:num)/edit'] = 'tests/edit/$1';
$route['tests/(:num)/delete'] = 'tests/delete/$1';

//Campaigns
$route['campaigns/index'] = 'campaigns/index';
$route['campaigns/create'] = 'campaigns/create';
$route['campaigns/(:num)/edit'] = 'campaigns/edit/$1';
$route['campaigns/(:num)/delete'] = 'campaigns/delete/$1';
$route['campaigns/(:num)/tests'] = 'campaigns/tests/$1';
$route['campaigns/(:num)/tests/export'] = 'campaigns/export_tests/$1';
$route['campaigns/(:num)/tests/remove/(:num)'] = 'campaigns/remove_test/$1/$2';
$route['campaigns/(:num)/tests/add/(:num)'] = 'campaigns/add_test/$1/$2';
$route['campaigns/calendar'] = 'campaigns/calendar';
$route['campaigns/calfeed'] = 'campaigns/calfeed';

//REST API
$route['api/tests'] = 'api/getTests';
$route['api/tests/(:num)/steps'] = 'api/getSteps/$1';
$route['api/tests/(:num)/status'] = 'api/getLatestExecutionStatus/$1';

$route['default_controller'] = 'tests';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
