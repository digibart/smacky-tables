<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('America/Chicago');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
switch (Arr::get($_SERVER, 'SERVER_ADDR'))
{
	case Arr::get($_SERVER, 'REMOTE_ADDR'):
		Kohana::$environment = KOHANA::TESTING;
		break;
	default:
		Kohana::$environment = KOHANA::PRODUCTION;
		break;
}
Kohana::$environment = KOHANA::PRODUCTION;
/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
	'base_url'   => '/',
	'index_file' => false,
	'errors' => true,
	'profiling' => (Kohana::$environment == KOHANA::DEVELOPMENT),
	'caching' => (Kohana::$environment == KOHANA::PRODUCTION)
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File()); 
Kohana::$config->attach(new Config_File('config/production'));

if (Kohana::$environment > KOHANA::PRODUCTION) 
{
	Kohana::$config->attach(new Config_File('config/testing'));
}

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
$modules = array(
	'killeradmin' 	=> MODPATH.'killeradmin',
	 'auth'       	=> MODPATH.'auth', 
	 'cache'      	=> MODPATH.'cache',
	 'captcha'    	=> MODPATH.'captcha',
	// 'codebench'  => MODPATH.'codebench',
	 'database'  	=> MODPATH.'database',
	// 'image'     	=> MODPATH.'image',
	 'orm'       	=> MODPATH.'orm',
	 'pagination'  	=> MODPATH.'pagination',
	// 'unittest'   => MODPATH.'unittest',
);

if (KOHANA::$environment == KOHANA::TESTING)
{
	$modules['userguide'] = MODPATH.'userguide';  // User guide and API documentation
}
Kohana::modules($modules);

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('error', 'error/<action>/<origuri>/<message>', array('action' => '[0-9]++', 'origuri' => '.+', 'message' => '.+')) 
->defaults(array( 
    'controller' => 'error', 
    'action'     => 'index',
)); 


Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'table',
		'action'     => 'index',
	));
