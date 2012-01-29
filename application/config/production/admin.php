<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'company_name' => 'Smacky Tables',
	'base_url' => 'admin',				// http://localhost/ko3-url/{admin}
	'menu' =>
	array(
		'admin/dashboard' => array(
			'name' => ucfirst(__('dashboard')),
			'secure_actions' => array(
				'default' => 'login',
				'index' => 'login',
			),
		),		
		'admin/users' => array(
			'name' => ucfirst(__('employees')),	// name shown in menu
			'secure_actions' => array(		// Controls access to specified actions
				'default' => 'admin',		// default role required to access the actions in this controller
				'index' => 'admin',			// required role to list users 
				'add' => 'admin',			// required role to add new users
				'edit' => 'admin',			// required role to edit users
				'delete' => 'admin'			// required role to delete users
			),
		),
		'admin/main' => array(
			'name' => ucfirst(__('dashboard')),
			'secure_actions' => array(
				'default' => 'login'
			),
		),
		'admin/tables' => array(			
			'name' => ucfirst(__('tables')),
			'secure_actions' => array(		
				'default' => 'waitress',		
				'index' => 'waitress',			
				'add' => 'admin',	
				'edit' => 'admin',			
				'delete' => 'admin'			
			),
		),
		
		'admin/reservations' => array(			
			'name' => ucfirst(__('reservations')),
			'secure_actions' => array(		
				'default' => 'waitress',		
				'index' => 'waitress',			
				'add' => 'admin',	
				'edit' => 'waitress',			
				'delete' => 'admin'			
			),
		),
		
		'admin/settings' => array(
			'name' => ucfirst(__('settings')),
			'hidden' => true, //don't show in menu
			'secure_actions' => array(
				'default' => 'login'
			),
		),
	)
);
