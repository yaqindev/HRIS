<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Drivers
| 4. Helper files
| 5. Custom config files
| 6. Language files
| 7. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/

$autoload['packages'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your application/libraries folder.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'email', 'session');
|
| You can also supply an alternative library name to be assigned
| in the controller:
|
|	$autoload['libraries'] = array('user_agent' => 'ua');
*/

$autoload['libraries'] = array('database','session','tanggal');


/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| These classes are located in the system/libraries folder or in your
| application/libraries folder within their own subdirectory. They
| offer multiple interchangeable driver options.
|
| Prototype:
|
|	$autoload['drivers'] = array('cache');
*/

$autoload['drivers'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/

$autoload['helper'] = array('url');
$autoload['helpers'] = array('form','myhelper');


/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/

$autoload['config'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/

$autoload['language'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('first_model', 'second_model');
|
| You can also supply an alternative model name to be assigned
| in the controller:
|
|	$autoload['model'] = array('first_model' => 'first');
*/

$autoload['model'] = array(
	'M_user' 								=> 'user',
	'M_security'							=> 'm_security',
	'M_employee'		 					=> 'tbl_employee',
	'M_personal_detail'		 				=> 'tbl_personal_detail',
	'M_department'		 					=> 'tbl_department',
	'M_segment'		 						=> 'tbl_segment',
	'M_group'		 						=> 'tbl_group',
	'M_jobtitle'		 					=> 'tbl_jobtitle',
	'M_kpi' 								=> 'tbl_kpi',
	'M_kra' 								=> 'tbl_kra',
	'M_unit_competency' 					=> 'tbl_unit_competency',
	'M_standard_competency' 				=> 'tbl_standard_competency',
	'M_kpi_monitoring'		 				=> 'tbl_kpi_monitoring',
	'M_kpi_evaluation'		 				=> 'tbl_kpi_evaluation',
	'M_periode'		 						=> 'tbl_periode',
	'M_year'		 						=> 'tbl_year',
	'M_assessement'		 					=> 'tbl_assessement',
	'M_performance_appraisal_detail'		=> 'tbl_performance_appraisal_detail',
	'M_performance_appraisal'				=> 'tbl_performance_appraisal',
	'M_zap'									=> 'tbl_zap',
	'M_disciplinary'						=> 'tbl_disciplinary',
	'M_disciplinary_monitoring'				=> 'tbl_disciplinary_monitoring',
	'M_disciplinary_evaluation'				=> 'tbl_disciplinary_evaluation',
);

