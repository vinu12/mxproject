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
  | When you set this option to TRUE, it will replace ALL dashes with
  | underscores in the controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
//$route['default_controller'] = 'User';
//$route['404_override'] = '';
//$route['translate_uri_dashes'] = FALSE;


$route['default_controller'] = 'User';

$route['admin'] = 'User';

$route['404_override'] = 'Error_pages/index';

/* admin */
$route['admin'] = 'User/index';


$route['admin/signup'] = 'User/signup';
$route['admin/create_member'] = 'User/create_member';
$route['admin/login'] = 'User/index';
$route['Admin/forgotPassword'] = 'User/forgotPassword';
$route['Admin/loginMe'] = 'User/loginMe';

$route['admin/adminusers/userListing'] = 'admin_adminusers/userListing';
$route['admin/adminusers/userListing/(:any)'] = "admin_adminusers/userListing/$1";





$route['addNew'] = "user/addNew";


$route['admin/logout'] = 'User/logout';
$route['admin/login/validate_credentials'] = 'User/validate_credentials';

$route['admin/adminusers/updatemember'] = 'admin_adminusers/updatemember';
$route['admin/adminusers/dashboard'] = 'admin_adminusers/dashboard';
$route['admin/adminusers'] = 'admin_adminusers/index';
$route['admin/adminusers/add'] = 'admin_adminusers/add';
$route['admin/adminusers/create_member'] = 'admin_adminusers/create_member';
$route['admin/adminusers/delete/(:any)'] = 'admin_adminusers/delete/$1';
$route['admin/adminusers/updateuser/(:any)'] = 'admin_adminusers/updateuser/$1';
$route['admin/adminusers/updateemail/(:any)'] = 'admin_adminusers/updateemail/$1';

$route['admin/commanlist'] = 'admin_adminusers/index';




$route['admin/summarycontrols/viewsummary/(:any)'] = 'admin_summarycontrols/viewsummary/$1';



$route['admin/cmscontrols/viewinformation'] = 'admin_cmscontrols/viewinformation';
$route['admin/cmscontrols/viewinformation/(:any)'] = 'admin_cmscontrols/viewinformation/$1';

$route['admin/cmscontrols/viewinformation'] = 'admin_cmscontrols/viewinformation/$4';
$route['admin/cmscontrols/viewinformation/(:any)/(:num)'] = 'admin_cmscontrols/viewinformation/$4/$5';


$route['admin/cmscontrols/view'] = 'admin_cmscontrols/view';
$route['admin/cmscontrols/view'] = 'admin_cmscontrols/view/$4';
$route['admin/cmscontrols/view/(:any)/(:num)'] = 'admin_cmscontrols/view/$4/$5';
$route['admin/cmscontrols/updatemetainformation'] = 'admin_cmscontrols/updatemetainformation';
$route['admin/cmscontrols/updatemetarecord/(:any)'] = 'admin_cmscontrols/updatemetarecord/$1';
$route['admin/cmscontrols/deletemetarecord/(:any)'] = 'admin_cmscontrols/deletemetarecord/$1';
$route['admin/cmscontrols/add'] = 'admin_cmscontrols/add';

$route['admin/cmscontrols/addauthors'] = 'admin_cmscontrols/addauthors';
$route['admin/cmscontrols/viewauthors'] = 'admin_cmscontrols/viewauthors';
$route['admin/cmscontrols/viewauthors'] = 'admin_cmscontrols/viewauthors/$4';
$route['admin/cmscontrols/viewauthors/(:any)/(:num)'] = 'admin_cmscontrols/viewauthors/$4/$5';
$route['admin/cmscontrols/updateauthorinfo'] = 'admin_cmscontrols/updateauthorinfo';




$route['admin/industries']= 'admin_industries/viewindustries';
$route['admin/industries/viewindustries']= 'admin_industries/viewindustries';
$route['admin/industries/viewindustries/(:any)']= 'admin_industries/viewindustries/$1';
$route['admin/industries/delete/(:any)/(:any)']= 'admin_industries/deleteRecord/$1/$2';

$route['admin/industries/edit/(:any)/(:any)']= 'admin_industries/editIndustries/$1/$2';

$route['admin/industries/update/(:any)/(:any)']= 'admin_industries/updateIndustries/$1/$2';

$route['admin/industries/add'] = 'admin_industries/add';

$route['admin/industries/adding'] = 'admin_industries/saveadd';


$route['admin/affiliates']= 'admin_affiliates/viewaffiliates';
$route['admin/affiliates/viewaffiliate']= 'admin_affiliates/viewaffiliates';
$route['admin/affiliates/viewaffiliate/(:any)']= 'admin_affiliates/viewaffiliates/$1';
$route['admin/affiliates/approve/(:any)/(:any)']= 'admin_affiliates/approved/$1/$2';
$route['admin/affiliates/reject/(:any)/(:any)']= 'admin_affiliates/reject/$1/$2';





$route['admin/cmscontrols/deleteauthorrecord/(:any)'] = 'admin_cmscontrols/deleteauthorrecord/$1';
$route['admin/cmscontrols/updateauthordrecord/(:any)'] = 'admin_cmscontrols/updateauthordrecord/$1';

$route['admin/event'] = 'Eventreg_controllers/register';

 $route['admin/active'] = 'Eventreg_controllers/active_banner';

$route['admin/cmscontrols/updateinfo'] = 'admin_cmscontrols/updateinfo';
$route['admin/cmscontrols/addinformation'] = 'admin_cmscontrols/addinformation';
$route['admin/cmscontrols/deleterecord/(:any)'] = 'admin_cmscontrols/deleterecord/$1';
$route['admin/cmscontrols/updaterecord/(:any)'] = 'admin_cmscontrols/updaterecord/$1';
$route['admin/cmscontrols/addinformation'] = 'admin_cmscontrols/addinformation';





