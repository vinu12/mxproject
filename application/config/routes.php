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

$route['translate_uri_dashes'] = TRUE;
$route['default_controller'] = 'User';

#$route['admin'] = 'User';
$route['404_override'] = 'Error_pages/index';


$route['diploma-in-leadership-and-management'] = 'courses/diplomainleadershipandmanagement';
$route['diploma-in-it'] = 'courses/diplomainit';
$route['bachelor-in-itc'] = 'courses/bachelorinitc';
$route['bachelor-in-business'] = 'courses/bachelorinbusiness';
$route['bachelor-in-commerce'] = 'courses/bachelorincommerce';
$route['bachelor-of-information-system'] = 'courses/bachelorofinformationsystem';

$route['master-of-technology'] = 'courses/masteroftechnology';
$route['master-of-professional-accounting'] = 'courses/masterofprofessionalaccounting';
$route['master-of-business-adminstrator'] = 'courses/masterofbusinessadminstrator';






$route['profyear'] = 'User/profyear';
$route['advertise'] = 'User/advertise';
$route['register'] = 'User/register';
$route['ourteam'] = 'User/ourteam';
$route['aboutus'] = 'User/aboutus';
$route['ourservices'] = 'User/ourservices';
$route['courses'] = 'User/program';
$route['contactus'] = 'User/contactus';
$route['study-in-australia'] = 'User/studyinaustralia';
$route['study-in-new-zealand'] = 'User/studyinnewzealand';
$route['study-in-canada'] = 'User/studyincanada';
$route['study-in-europe'] = 'User/studyineurope';
$route['study-in-usa'] = 'User/studyinusa';
$route['study-in-uk'] = 'User/studyinuk';
$route['arts'] = 'User/arts';
$route['accounts-banking-and-finance'] = 'User/accountsbankingandfinance';
$route['computer-science-and-it'] = 'User/computerscienceandit';
$route['business-and-management'] = 'User/businessandmanagement';
$route['engineering'] = 'User/engineering';
$route['fashion-and-ethics'] = 'User/fashionandethics';
$route['hospitality-tourism-and-hotelmanagement'] = 'User/hospitalitytourismandhotelmanagement';
$route['law'] = 'User/law';
$route['media-and-creative-arts'] = 'User/mediaandcreativearts';
$route['nursing'] = 'User/nursing';






$route['ielts'] = 'User/ielts';
//$route['program/(:any)'] = 'User/courses/details/$1';


$route['redirect'] = 'User/redirect';
$route['my-stripe'] = "StripeController";
$route['stripePost']['post'] = "StripeController/stripePost";









