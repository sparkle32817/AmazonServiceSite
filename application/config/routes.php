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
$route['default_controller'] = 'index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
 * User Controllers Routes
 */

//Language Translate
$route['LanguageSwitcher/switchLang/(:any)'] = 'user/LanguageSwitcher/switchLang/$1';

//User Login.
$route['login'] = 'user/login';
$route['login/register'] = 'user/login/register';

//Home
$route['home'] = 'user/home';
$route['home/logout'] = 'user/home/logout';
$route['home/history'] = 'user/home/history';

//Billing
$route['billing/membership'] = 'user/billing/membership';
$route['billing/payment'] = 'user/billing/payment';

//Profile
$route['profile'] = 'user/profile';
$route['profile/update'] = 'user/profile/update';
$route['profile/password_update'] = 'user/profile/password_update';
$route['profile/image_upload'] = 'user/profile/image_upload';

//Service
$route['services/marketurl'] = 'user/services/MarketUrlGernerator/index';
$route['services/marketurl/asinkeyword'] = 'user/services/MarketUrlGernerator/asinkeyword';
$route['services/marketurl/asinkeyword_special'] = 'user/services/MarketUrlGernerator/asin_keyword_special';
$route['services/marketurl/search_engine'] = 'user/services/MarketUrlGernerator/search_engine_amazon_url';
$route['services/marketurl/add_cart_url'] = 'user/services/MarketUrlGernerator/add_cart_url';
$route['services/marketurl/add_cart_multi'] = 'user/services/MarketUrlGernerator/add_cart_multiple_url';
$route['services/marketurl/search_multi_asin'] = 'user/services/MarketUrlGernerator/search_multi_asin';
$route['services/big_data/category'] = 'user/services/BigData/category';
$route['services/big_data/categoryResultView/(:any)'] = 'user/services/BigData/categoryResultView/$1';
$route['services/big_data/advertising'] = 'user/services/BigData/advertising';
$route['services/big_data/advertisingResultView/(:any)'] = 'user/services/BigData/advertisingResultView/$1';
$route['services/big_data/product'] = 'user/services/BigData/product';
$route['services/big_data/productResultView/(:any)'] = 'user/services/BigData/productResultView/$1';
$route['services/big_data/keyword'] = 'user/services/BigData/keyword';
$route['services/big_data/keywordResultView/(:any)'] = 'user/services/BigData/keywordResultView/$1';
$route['services/listing_stuffer'] = 'user/services/ListingKeywordStuffer';
$route['services/listing_stuffer/resultView/(:any)'] = 'user/services/ListingKeywordStuffer/resultView/$1';
$route['services/account_management'] = 'user/services/AccountManagement';
$route['services/account_management/main'] = 'user/services/AccountManagement/main';
$route['services/account_management/view'] = 'user/services/AccountManagement/view';
$route['services/find_related_keywords'] = 'user/services/RelatedKeywords';
$route['services/image_hosting'] = 'user/services/ImageHosting';
$route['services/image_hosting/resultView/(:any)'] = 'user/services/ImageHosting/resultView/$1';
$route['services/keyword_index_checker'] = 'user/services/ProductKeywordIndexChecker';
$route['services/keyword_index_checker/resultView/(:any)'] = 'user/services/ProductKeywordIndexChecker/resultView/$1';
$route['services/keyword_index_checker'] = 'user/services/ProductKeywordIndexChecker';
$route['services/magnet_search'] = 'user/services/MagnetRelatedKeywordSearch';
$route['services/magnet_search/resultView/(:any)'] = 'user/services/MagnetRelatedKeywordSearch/resultView/$1';
$route['services/keyword_rank_tracking'] = 'user/services/KeywordRankTracking/index';
$route['services/key_track_new'] = 'user/services/KeywordRankTracking/createNewProduct';
$route['services/key_track_result'] = 'user/services/KeywordRankTracking/getAllAsinInfo';
$route['services/key_track_result_detail'] = 'user/services/KeywordRankTracking/getIndividualAsinInfo';
$route['services/reverse_search'] = 'user/services/ReverseAsinSearch';
$route['services/reserve_search/resultView/(:any)'] = 'user/services/ReverseAsinSearch/resultView/$1';
$route['services/keyword_optimization'] = 'user/services/SearchTermOptimization';
$route['services/keyword_optimization/resultView/(:any)'] = 'user/services/SearchTermOptimization/resultView/$1';

/*
 * admin Controller Routes
 */
//Login
$route['login_'] = 'admin/login';


//Home-->ClientMng
$route['admin'] = 'admin/home';
$route['admin/client_edit']         = 'admin/home/client_edit';
$route['admin/client_view']         = 'admin/home/viewClient';
$route['admin/client_update']       = 'admin/home/client_update';
$route['admin/client_delete']       = 'admin/home/client_delete';
$route['admin/client_info_period']  = 'admin/home/client_info_period';
$route['admin/client_function_period']= 'admin/home/client_function_period';
$route['admin/getServiceName']      = 'admin/home/getServiceName';
$route['admin/export_client_info']  = 'admin/home/export_client_info';
$route['admin/change_password']     = 'admin/home/password_update';

//EmployeeMng
$route['admin/employee']            = 'admin/employeeMng/employee_mng';
$route['admin/employee_sess']       = 'admin/employeeMng/employee_session';
$route['admin/employee_create']     = 'admin/employeeMng/employee_create';
$route['admin/employee_edit']       = 'admin/employeeMng/employee_edit';
$route['admin/employee_update']     = 'admin/employeeMng/employee_update';
$route['admin/employee_delete']     = 'admin/employeeMng/employee_delete';
$route['admin/employee_enable_status'] = 'admin/employeeMng/employee_enable_status';
$route['admin/employee_period']     = 'admin/employeeMng/employee_period';
$route['admin/export_employee_session'] = 'admin/employeeMng/export_employee_session';
$route['admin/export_employee_info'] = 'admin/employeeMng/export_employee_info';

//TaskMng
$route['admin/task_mng']            = 'admin/taskMng/task_mng';
$route['admin/task_over']           = 'admin/taskMng/task_over';
$route['admin/task_over_period']    = 'admin/taskMng/task_over_period';
$route['admin/export_task_overview']= 'admin/taskMng/export_task_overview';
$route['admin/task_pending']        = 'admin/taskMng/task_pending';
$route['admin/task_complete']       = 'admin/taskMng/task_complete';
$route['admin/task_edit']           = 'admin/taskMng/task_edit';


//ViewService
$route['admin/viewCategory/(:any)']       = 'admin/ViewServices/categoryResultView/$1';
$route['admin/viewAdvertising/(:any)']    = 'admin/ViewServices/advertisingResultView/$1';
$route['admin/viewProduct/(:any)']       = 'admin/ViewServices/productResultView/$1';
$route['admin/viewKeyword/(:any)']       = 'admin/ViewServices/keywordResultView/$1';
$route['admin/viewKeywordChecker/(:any)']       = 'admin/ViewServices/keywordCheckerResultView/$1';
$route['admin/viewMagnetSearch/(:any)']       = 'admin/ViewServices/magnetSearchResultView/$1';
$route['admin/viewReverseSearch/(:any)']       = 'admin/ViewServices/reverseSearchResultView/$1';
$route['admin/viewKeywordOptimization/(:any)']       = 'admin/ViewServices/keywordOptimizationResultView/$1';


/*
 * employee Controller Routes
 */
//Login
$route['login_'] = 'admin/login';


//Home
$route['employee'] = 'employee/BigData';
$route['employee/pending'] = 'employee/BigData/getTaskDetailInfo';
$route['employee/pending_table'] = 'employee/BigData/getPendingTableInfo';
$route['employee/complete_table'] = 'employee/BigData/getCompleteTableInfo';
$route['employee/password_update'] = 'employee/BigData/password_update';
$route['employee/start_working'] = 'employee/BigData/startTask';
$route['employee/completeTask'] = 'employee/BigData/completeTask';

