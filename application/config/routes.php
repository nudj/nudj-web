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
|	https://codeigniter.com/user_guide/general/routing.html
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

$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['charlottetilbury/HR17001'] = 'job/ct';
$route['mrandmrssmith/ma17001'] = 'job/mr';
$route['cefinn/ma17001'] = 'job/cefinn_ecom';
$route['cefinn/ma17002'] = 'job/cefinn_finan';

$route['job/preview'] = 'job/preview';
$route['job/unique-link'] = 'job/uniqueLink';
$route['job/create-referral'] = 'job/create_referral';
$route['job/edit/(:any)'] = 'job/edit';
$route['job/(:any)'] = 'job/index';
$route['job/(:any)/referral/(:any)'] = 'job/index';

$route['candidates/(:any)'] = 'candidates/index';

$route['explore/charlottetilbury/HR17001'] = 'apply/ct';
$route['explore/mrandmrssmith/ma17001'] = 'apply/mr';
$route['explore/cefinn/ma17001'] = 'apply/cef_man';
$route['explore/cefinn/ma17002'] = 'apply/cef_fin';

$route['explore/job/(:any)'] = 'apply/index';
$route['explore/job/(:any)/referral/(:any)'] = 'apply/index';

$route['success'] = 'success/index';

$route['signup'] = 'signup/index';
$route['signin'] = 'login/index';
$route['signin/google_auth'] = 'login/google_auth';
$route['signin/linkedin_auth'] = 'login/linkedin_auth';

//$route['signin/(:any)'] = 'login/index/$1';

$route['dashboard'] = 'profile/index';
$route['logout'] = 'profile/logout';

$route['add-job'] = 'addjob/index';
$route['add-job/ask-for-referral/(:any)'] = 'addjob/askForReferral';
$route['add-job/ask-referral-network'] = 'addjob/askForReferralEntireNetwork';
$route['add-job/preview'] = 'addjob/goToPreview';
$route['add-job/create-job'] = 'addjob/createJob';

$route['dashboard'] = 'dashboard/index';
$route['logout'] = 'dashboard/logout';

$route['profile'] = 'profile/index';

